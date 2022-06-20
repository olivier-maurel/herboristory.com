<?php

namespace App\Service;

use App\Entity\PlantFeature;
use App\Repository\PlantAttributeRepository;


class PlantService
{
    public function __construct(PlantAttributeRepository $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function sortAttributes(PlantFeature $feature = null)
    {
        if (!is_null($feature))
            $attributes = $feature->getAttributes();
        else 
            $attributes = $this->attributeService->findAll();

        foreach ($attributes as $attribute)
            $result[$attribute->getType()][] = $attribute;

        return $result;
    }

}