<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ApiController
 *
 * @package AppBundle\Controller
 *
 * @Route("api")
 */
class ApiController extends Controller
{
    /**
     * Get all event for fullCalendar
     *
     * @Route("/calendar", name="event_api")
     *
     * @return string
     */
    public function getJsonEventAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository(Event::class)->findAll();

        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();

        $callback = function ($dateTime) {
            return $dateTime instanceof \DateTime
                ? $dateTime->format(\DateTime::ISO8601)
                : '';
        };
        $normalizer->setCallbacks(
            array(
            'start' => $callback,
            'deadline' => $callback
            )
        );

        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $jsonEvents = $serializer->serialize($events, 'json');

        return new Response($jsonEvents);
    }

    /**
     * @Route("/resultsearch", name="result_search")
     *
     * @Method("POST")
     */
    public function renderResultAction(Request $request){
        if ($request->isXmlHttpRequest()){
            $location = strtolower(str_replace(", France", "", $request->get('location')));
            $end = new \DateTime($request->get('end'));

            $em = $this->getDoctrine()->getManager();

            $events = $em->getRepository(Event::class)->getAllNotPrivateEvent($this->getUser(), $location, $end);

            $response = array(
                'eventDescription' => $this->renderView('default/includes/cardEventRender.html.twig', array(
                    'events' => $events
                )),
                'eventModal' => $this->renderView('default/includes/modalEventRender.html.twig', array(
                    'events' => $events
                ))
            );

            return new JsonResponse($response);
        } else{
            throw new HttpException("error call method", 500);
        }
    }
}