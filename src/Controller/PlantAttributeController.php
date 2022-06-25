<?php

namespace App\Controller;

use App\Entity\PlantAttribute;
use App\Form\PlantAttributeType;
use App\Repository\PlantAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $plantAttribute = new PlantAttribute();
        $form = $this->createForm(PlantAttributeType::class, $plantAttribute);

        return $this->renderForm('plant_feature_secondary/index.html.twig', [
            'plant_feature_secondaries' => $plantFeatureSecondaries,
            'form' => $form
        ]);
    }

    /**
     * @Route("/new/{id}", name="app_plant_feature_secondary_new", methods={"POST"}, defaults={"id" = 0})
     */
    public function new(int $id = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($id != null)
            $plantAttribute = $entityManager
                ->getRepository(PlantAttribute::class)
                ->findOneById($id);
        else
            $plantAttribute = new PlantAttribute();

        $form = $this->createForm(PlantAttributeType::class, $plantAttribute);
        $form->handleRequest($request);

        if ($id === null)
            $entityManager->persist($plantAttribute);
        $entityManager->flush();

        $plantFeatureSecondaries = $entityManager
            ->getRepository(PlantAttribute::class)
            ->findAll();

        return new JsonResponse([
            'html' => $this->renderView('plant_feature_secondary/_table.html.twig', [
                'plant_feature_secondaries' => $plantFeatureSecondaries,
                'id' => $id
            ])
        ]);
    }

    /**
     * @Route("/show", name="app_plant_feature_secondary_show", methods={"GET"})
     */
    public function show(Request $request, PlantAttributeRepository $plantAttributeRepository): Response
    {
        $id =  $request->query->get('id');
        $plantAttribute = $plantAttributeRepository->findOneById($id);

        return new JsonResponse([
            'id'    => $plantAttribute->getId(),
            'type'  => $plantAttribute->getType(),
            'label' => $plantAttribute->getLabel(),
            'icon'  => $plantAttribute->getIcon(),
            'color' => $plantAttribute->getColor(),
            'value' => $plantAttribute->getValue()
        ]);
    }

    // /**
    //  * @Route("/edit", name="app_plant_feature_secondary_edit", methods={"POST"})
    //  */
    // public function edit(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $plantAttribute = $entityManager
    //         ->getRepository(PlantAttribute::class)
    //         ->findOneById($request->request->get('id'));
    //     $form = $this->createForm(PlantAttributeType::class, $plantAttribute);
    //     $form->handleRequest($request);
    //     $entityManager->flush();

    //     $plantFeatureSecondaries = $entityManager
    //         ->getRepository(PlantAttribute::class)
    //         ->findAll();

    //     return new JsonResponse([
    //         'html' => $this->renderView('plant_feature_secondary/_table.html.twig', [
    //             'plant_feature_secondaries' => $plantFeatureSecondaries,
    //         ])
    //     ]);
    // }

    /**
     * @Route("/delete/{id}", name="app_plant_feature_secondary_delete", methods={"POST"}, requirements={"id" = "\d+"}, defaults={"id" = null})
     */
    public function delete(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $plantAttribute = $entityManager
            ->getRepository(PlantAttribute::class)
            ->findOneById($id);

        $entityManager->remove($plantAttribute);
        $entityManager->flush();
        
        $plantFeatureSecondaries = $entityManager
            ->getRepository(PlantAttribute::class)
            ->findAll();

        return new JsonResponse([
            'html' => $this->renderView('plant_feature_secondary/_table.html.twig', [
                'plant_feature_secondaries' => $plantFeatureSecondaries,
            ])
        ]);
    }
}
