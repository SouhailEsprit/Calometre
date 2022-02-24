<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use App\Security\EmailVerifier;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserController extends AbstractController
{

    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }
    
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/user.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/edit", name="edit_user")
     */
    public function editAccount(Request $req, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ChangePasswordType::class, $user)
            
            ->add('old_password', PasswordType::class, ['mapped' => false, 'attr' => ['placeholder' => 'old password']])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => true,
                'first_options' => [
                    'label' => 'New password',
                    'attr' => [
                        'placeholder' => '...',
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm password',
                    'attr' => [
                        'placeholder' => '...',
                    ]
                ]
            ])
           ;
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $old_password = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user, $old_password)) {
                $new_password = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_password);
                $user->setPassword($password);
                $em->flush();
                return $this->redirectToRoute('app_logout');
            }
        }
        return $this->render('registration/change_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/delete", name="delete_account")
     */
    public function deleteAccount(): Response
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $session = new Session();
        $session->invalidate();
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('app_logout');
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function back (): Response
    {
        return $this->render('user/admin.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/admin/register", name="register_account")
     */

    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, AppAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
            // ->add('Firstname', TextType::class,  ['disabled' => true])
            // ->add('Lastname', TextType::class,  ['disabled' => true])
            // ->add('email', TextType::class,  ['disabled' => true])
            // ->add('Phonenumber', NumberType::class, ['disabled' => true]);
            // ->add('change', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilePicture = $form->get('profile_picture')->getData();
            if ($profilePicture) {
                // this is needed to safely include the file name as part of the URL
                $newFilename = uniqid() . '.' . $profilePicture->guessExtension();
                // Move the file to the directory where pictures are stored
                try {
                    $profilePicture->move(
                        $this->getParameter('profile_picture_dir'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setProfilePicture($newFilename);
            }
            // encode the plain password
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_ADMIN"]);
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('crinnxx@gmail.com', 'calometreBot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

        
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/adminregister.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/edit", name="edit_admin")
     */
    public function editadminAccount(Request $req, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ChangePasswordType::class, $user)
            ->add('Firstname', TextType::class,  ['disabled' => true])
            ->add('Lastname', TextType::class,  ['disabled' => true])
            ->add('email', TextType::class,  ['disabled' => true])
            // ->add('profilePicture', FileType::class, [
            //     'label' => 'Profile picture',
            //     'mapped' => false,
            //     'constraints' => [
            //         new Image(),
            //         new NotBlank(),
            //         new File([
            //             'mimeTypes' => [
            //                 'image/*',
            //             ],
            //             'mimeTypesMessage' => 'Please upload a valid picture type',
            //         ])
            //     ]
            // ])
            ->add('Phonenumber', NumberType::class, ['disabled' => true])
            ->add('old_password', PasswordType::class, ['mapped' => false, 'attr' => ['placeholder' => 'old password']])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => true,
                'first_options' => [
                    'label' => 'New password',
                    'attr' => [
                        'placeholder' => '...',
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm password',
                    'attr' => [
                        'placeholder' => '...',
                    ]
                ]
            ])
            ->add('change', SubmitType::class);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            // $profilePicture = $form->get('profilePicture')->getData();
            // if ($profilePicture) {
            //     // this is needed to safely include the file name as part of the URL
            //     $newFilename = uniqid() . '.' . $profilePicture->guessExtension();
            //     // Move the file to the directory where pictures are stored
            //     try {
            //         $profilePicture->move(
            //             $this->getParameter('profile_picture_dir'),
            //             $newFilename
            //         );
            //     } catch (FileException $e) {
            //         // ... handle exception if something happens during file upload
            //     }

            //     // updates the 'brochureFilename' property to store the PDF file name
            //     // instead of its contents
            //     $user->setProfilePicture($newFilename);
            // }
            $old_password = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user, $old_password)) {
                $new_password = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_password);
                $user->setPassword($password);
                $em->flush();
                return $this->redirectToRoute('user');
            }
        }
        return $this->render('registration/adminchange_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/listusers", name="users_list", methods={"GET"})
     */
    public function list_users()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/listusers.html.twig', [
            "users" => $users,
        ]);
    }
    /**
     * @Route("/user/editmail", name="edit_mail")
     */
    public function editEmail(Request $req, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ChangePasswordType::class, $user)
            ->add('email', EmailType::class)
            
            ->add('old_password', PasswordType::class, ['mapped' => false, 'attr' => ['placeholder' => 'old password']])
            
            ->add('change', SubmitType::class);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $password = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user, $password)) {
                $em->flush();
                return $this->redirectToRoute('user');
            }
        }
        return $this->render('registration/change_mail.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/ban/{id}",name="ban_user")
     */
    public function banUser($id): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        if ($user->getRoles() == ["ROLE_ADMIN"]) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            $user->setIsBanned(true);
            $em->flush();

            return $this->redirectToRoute('users_list');
        } else {
            //TODO: redirect to a 404 page
            return $this->redirectToRoute('app_logout');
        }
    }

}