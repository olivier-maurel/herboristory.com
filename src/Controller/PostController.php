<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Service\PlantService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="app_post_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findByPlant(null);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/new/{plant}", name="app_post_new", methods={"GET", "POST"})
     */
    public function new(Plant $plant = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setPlant($plant);
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
            'plant' => $plant
        ]);
    }

    /**
     * @Route("/{slug}", name="app_post_show", methods={"GET"})
     */
    public function show(string $slug, Request $request, PlantService $plantService): Response
    {
        $entityManager  = $this->getDoctrine()->getManager();
        $postRepository = $entityManager->getRepository(Post::class);
        $post  = $postRepository->findOneBySlug($slug);
        $plant = $post->getPlant();
        $attr  = ($plant) 
            ? $plantService->sortAttributes($plant->getFeature()) 
            : $postRepository->findOthersPosts($post, 6);

        if ($request->isXmlHttpRequest()) {

            $template = ($plant == null) ? '_without_plant' : ''; 
            $item     = $request->query->get('item') . $template;

            return new JsonResponse([
                'html' => $this->renderView('post/_show_'.$item.'.html.twig', [
                    'post' => $post,
                    'attr' => $attr
                ])
            ]);

        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_post_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_post_delete", methods={"POST"})
     */
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
