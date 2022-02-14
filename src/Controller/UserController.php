<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
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

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    // /**
    //  * @Route("/{id}/deletefs", name="fs_delete")
    //  */
    // public function deletefs($id): Response
    // {
    //     $this->denyAccessUnlessGranted('ROLE_ADMIN');

    //     // or add an optional message - seen by developers
    //     $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

    //     $entityManager = $this->getDoctrine()->getManager();
    //     $userRepository = $this->getDoctrine()->getRepository(user::class);
    //     $user = $userRepository->find($id);
    //     $entityManager->remove($user);
    //     $entityManager->flush();
    //     return $this->redirectToRoute('showfs');
    // }



    /**
     * @Route("/user/edit", name="edit_user")
     */
    public function editAccount(Request $req, UserPasswordEncoderInterface $encoder): Response
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
            ->add('change',SubmitType::class);
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
    
    
}