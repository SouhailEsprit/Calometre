<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    /**
     * @param PostRepository $postRepository
     * @return JsonResponse
     * @Route("/posts", name="posts", methods={"GET"})
     */
    public function getPosts(PostRepository $postRepository): JsonResponse
    {
        $data = $postRepository->findAll();
        return $this->response($data);
    }

    /**
     * @param PostRepository $postRepository
     *
     * @return JsonResponse
     * @Route("/postsByName", name="postsByName", methods={"GET"})
     */
    public function getPostsByName(PostRepository $postRepository): JsonResponse
    {
        $name = $_GET["name"];
        $data = $postRepository->searchPost($name);
        return $this->response($data);
    }

    /**
     * @param PostRepository $postRepository
     *
     * @return JsonResponse
     * @Route("/postById", name="postById", methods={"GET"})
     */
    public function getPostById(PostRepository $postRepository): JsonResponse
    {
        $id = $_GET["id"];
        $data = $postRepository->find($id);
        return $this->response([$data]);
    }

    /**
     * @param EventRepository $eventRepository
     * @return JsonResponse
     * @Route("/events", name="events")
     */
    public function getEvent(EventRepository $eventRepository): Response
    {
        $data = $eventRepository->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($data, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**

     * @param EventRepository $eventRepository
     *
     * @return JsonResponse
     * @Route("/eventById", name="eventById", methods={"GET"})
     */
    public function getEventById(EventRepository $eventRepository): Response
    {
        $id = $_GET["id"];
        $data = $eventRepository->find($id);

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($data, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }



    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param EventRepository $EventRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/addEvent", name="Events_add", methods={"POST"})
     */
    public function addEvent(Request $request, EntityManagerInterface $entityManager, EventRepository $EventRepository): JsonResponse
    {


        try {
            $request = $this->transformJsonBody($request);



            $Event = new Event();
            $Event->setNom($request->get('nom'));
            $Event->setDateDebut($request->get('date_debut'));
            $Event->setDateFin($request->get('date_fin'));
            $Event->setDescription($request->get('description'));
            $Event->setNombreParticipants($request->get('nombre_participants'));
            $Event->setLieu($request->get('lieu'));
            $Event->setImage($request->get('image'));
            $entityManager->persist($Event);
            $entityManager->flush();

            $data = [
                'status' => 200,
                'responseData' => $Event,
                'responseMessage' => "Event added successfully"
            ];
            return $this->response($data);
        } catch (\Exception $e) {
            $data = [
                'status' => 422,
                'responseData' => null,
                'responseMessage' => $e->getMessage()
            ];
            return $this->response($data, 422);
        }
    }
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/removeEvent", name="Events_remove", methods={"POST"})
     */
    public function supprimerEvent(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $event = $em->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return new JsonResponse("OK");
    }
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/updateEvent", name="Events_update", methods={"POST"})
     */
    public function modifierEvent(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Event = $entityManager->getRepository(Event::class)->find($request->get("id"));
        $Event->setNom($request->get('nom'));
        $Event->setDateDebut($request->get('date_debut'));
        $Event->setDateFin($request->get('date_fin'));
        $Event->setDescription($request->get('description'));
        $Event->setNombreParticipants($request->get('nombre_participants'));
        $Event->setLieu($request->get('lieu'));
        $Event->setImage($request->get('image'));
        $entityManager->persist($Event);
        $entityManager->flush();
        return new JsonResponse("OK");
    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */



    public function response(array $data, int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}