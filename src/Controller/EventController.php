<?php

namespace App\Controller;


use App\{Entity\Comment,
    Entity\Event,
    Entity\User,
    Form\CommentType,
    Form\EventType,
    Repository\EventRepository,
    Repository\PostRepository};
use Doctrine\ORM\EntityManagerInterface;
use OTIFSolutions\PhpSentimentAnalysis\Sentiment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\equalTo;
use Snipe\BanBuilder\CensorWords;


/**
 * @Route("/event")
 */
class EventController extends AbstractController
{



    /**
     * @Route("/applyajax", name="participer_event")
     */
    public function applyToEvent(Request $request,EntityManagerInterface $entityManager)
    {
        $idEvent = $request->get('eventId');
        $event = $this->getDoctrine()->getRepository(Event::class)->findOneById($idEvent);
        $user = $this->getUser();
        $event->addUser($user);
        $user->addEvent($event);

        $event->setNombreParticipants($event->getNombreParticipants() - 1);
        $nouveaNombreParticipants = $event->getNombreParticipants();


        $entityManager->flush();

        return $this->render('event_front/numberParticipantsAjax.html.twig', [
            "nouveaNombreParticipants" => $nouveaNombreParticipants
        ]);

    }

    /**
     * @Route("/admin/display", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/client/display", name="event_client_index", methods={"GET"})
     */
    public function indexClient(EventRepository $eventRepository): Response
    {
        return $this->render('event_front/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            /** @var UploadedFile $image */
            $image = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = $originalFilename.'-'.uniqid().'.'.$image->guessExtension();


                try {
                    $image->move(
                        $this->getParameter('event_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $event->setImage($newFilename);
            }
            $eventName = $form->get('nom')->getData();

            if ($this->checkEventUnicity($eventName)){
                $entityManager->persist($event);
                $entityManager->flush();
                return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);

            }else {
                $this->addFlash('success', 'Name of the event already in use !!!');

            }




        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }



    /**
     * @Route("/client/display/{id}", name="event_front_show", methods={"GET","POST"})
     */
    public function showEventFront(Event $event ,Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $comment = new Comment();
        $comment->setUser($user);
        $comment->setCommentdate(new \DateTime('now'));
        $comment->setEvent($event) ;
        $comment->setLikecount(0);





        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if  ($form->isSubmitted() && $form->isValid()) {
            $commentContent =$form->get('commentcontent')->getData();
            $censor = new CensorWords;
            $badwords = $censor->setDictionary('fr');

            $string = $censor->censorString($commentContent);
            $comment->setCommentcontent($string['clean']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('event_front_show', ['id'=>$event->getId(),'form'=>$form], Response::HTTP_SEE_OTHER);

        }
            $comments = $this->getDoctrine()->getRepository(Comment::class)->findByEvent($event->getId());

        return $this->render('event_front/show.html.twig', [
            'event' => $event,
            'comments'=>$comments,
            'form'=>$form->createView(),
            'alreadyApplied'=>$event->getUsers()->contains($user)
        ]);
    }


    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            /** @var UploadedFile $image */
            $image = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = $originalFilename.'-'.uniqid().'.'.$image->guessExtension();


                try {
                    $image->move(
                        $this->getParameter('event_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $event->setImage($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"POST"})
     */
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);
    }




    public function checkEventUnicity(string $eventName){

        $eventList = $this->getDoctrine()->getRepository(Event::class)->findAll();
        foreach ($eventList as $ev){
            if($ev->getNom() == $eventName){
                return false;
            }
            else return true;
        }


    }


    //MOBILE
    /**
     * @Route("/displayJsonEvents", name="display_events_json", methods={"GET"})
     */

    public function afficherEvent2(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Event::class)->findAll();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);

        $formatted = $serializer->normalize(array("id"=>$event->getId(),
            "nom"=>$event->getNom(),
            "description"=>$event->getDescription(),
            "dateDebut"=>$event->getDateDebut(),
            "dateFin" => $event->getDateFin(),
            "image"=>$event->getImage(),
            "nombreParticipants"=>$event->getImaNombreParticipants(),
            "lieu"=>$event->getLieu()));



        return new JsonResponse($formatted);
    }



}
