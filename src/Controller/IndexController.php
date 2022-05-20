<?php

namespace App\Controller;

use App\Entity\Usr\Subscriber;
use App\Repository\PostRepository;
use App\Repository\Usr\SubscriberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; 

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(Request $request): Response
    {
        return $this->render('index/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/search", name="app_search")
     */
    public function search(Request $request, PostRepository $postRepository, PaginatorInterface $paginator): Response
    {
        $data = $postRepository->findBySearch(
            $request->query->get('q'),
            $request->query->get('c')
        );

        $posts = $paginator->paginate(
            $data, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('p', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        $list = ($request->query->get('l') == 'box' || $request->query->get('l') == 'row') ? $request->query->get('l') : 'row';

        if ($request->isXmlHttpRequest() && ($request->query->get('r') !== null)) {
            if ($request->query->get('r') === $request->get('_route'))
                return new JsonResponse([
                    'response' => $this->renderView('post/_listing_'.$list.'.html.twig', [
                        'posts' => $posts
                    ]),
                    'limit' => (count($posts) < 1) ?: false
                ]);
            else return new JsonResponse([
                'response' => true
            ]);
        }

        return $this->render('index/search.html.twig', [
            'posts' => $posts,
            'list' => $list
        ]);
    }

    /**
     * @Route("/construct", name="app_construct")
     */
    public function construct(Request $request): Response
    {
        return $this->render('_construct.html', [
            'hasSubscriber' => ($request->cookies->get('hasSubscriber')) ?: ''
        ]);
    }

    /**
     * @Route("/subscribe", name="app_subscribe")
     */
    public function subscribe(Request $request, SubscriberRepository $subscriberRepository): Response
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
