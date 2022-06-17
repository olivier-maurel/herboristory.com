<?php

namespace App\Controller;

use App\Entity\PlantAttribute;
use App\Form\PlantAttributeType;
use App\Repository\PlantAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plant/attribute")
 */
class PlantAttributeController extends AbstractController
{
    /**
     * @Route("/", name="app_plant_feature_secondary_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $plantFeatureSecondaries = $entityManager
            ->getRepository(PlantAttribute::class)
            ->findAll();

        return $this->render('plant_feature_secondary/index.html.twig', [
            'plant_feature_secondaries' => $plantFeatureSecondaries,
        ]);
    }

    /**
     * @Route("/new", name="app_plant_feature_secondary_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plantAttribute = new PlantAttribute();
        $form = $this->createForm(PlantAttributeType::class, $plantAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plantAttribute);
            $entityManager->flush();

            return $this->redirectToRoute('app_plant_feature_secondary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant_feature_secondary/new.html.twig', [
            'plant_feature_secondary' => $plantAttribute,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_plant_feature_secondary_show", methods={"GET"})
     */
    public function show(PlantAttribute $plantAttribute): Response
    {
        return $this->render('plant_feature_secondary/show.html.twig', [
            'plant_feature_secondary' => $plantAttribute,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_plant_feature_secondary_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PlantAttribute $plantAttribute, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlantAttributeType::class, $plantAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plant_feature_secondary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant_feature_secondary/edit.html.twig', [
            'plant_feature_secondary' => $plantAttribute,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_plant_feature_secondary_delete", methods={"POST"})
     */
    public function delete(Request $request, PlantAttribute $plantAttribute, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plantAttribute->getId(), $request->request->get('_token'))) {
            $entityManager->remove($plantAttribute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plant_feature_secondary_index', [], Response::HTTP_SEE_OTHER);
    }
}
