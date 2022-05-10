<?php

namespace App\Controller;

use App\Entity\Usr\Subscriber;
use App\Repository\Usr\SubscriberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/", name="app_construct")
     */
    public function construct(HttpFoundationRequest $request): Response
    {
        return $this->render('_construct.html', [
            'hasSubscriber' => ($request->cookies->get('hasSubscriber')) ?: ''
        ]);
    }

    /**
     * @Route("/subscribe", name="app_subscribe")
     */
    public function subscribe(HttpFoundationRequest $request, SubscriberRepository $subscriberRepository): Response
    {
        $email = $request->request->get('email');

        if ($subscriberRepository->findOneByEmail($email) === null) {

            $addrIp = $request->getClientIp();
            $subscriber = new Subscriber();

            if($addrIp == 'unknown')
                $addrIp = $_SERVER['REMOTE_ADDR'];

            $subscriber
                ->setEmail($email)
                ->setAddrIp($addrIp)
                ->setCreatedAt(new \DateTime())
            ;

            $subscriberRepository->add($subscriber, true);

            $cookie = Cookie::create('hasSubscriber', true);

            $content = [
                'message' => 'Votre adresse mail a bien été enregistrée',
                'alert' => 'success'
            ];

        } else 
            $content = [
                'message' => 'Cette adresse email est déjà inscrite',
                'alert' => 'danger'
            ];
        
        $response = new Response(json_encode($content));

        if (isset($cookie))
            $response->headers->setCookie($cookie);

        return $response;
    }
}
