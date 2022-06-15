<?php
namespace App\Extension;

use App\Entity\PlantFeature;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PlantExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('getIcon', [$this, 'getIcon']),
            new TwigFilter('getAlt', [$this, 'getAlt']),
            new TwigFilter('isToxic', [$this, 'isToxic']),
            new TwigFilter('getFeatures', [$this, 'getFeatures']),
        ];
    }

    public function getIcon(string $type): string
    {
        $fa = '';
        
        switch ($type) {
            case 'com':
                $fa = 'fa-utensils bg-warning';
                break;
            case 'med':
                $fa = 'fa-star-of-life bg-green';
                break;
            case 'tox':
                $fa = 'fa-skull-crossbones bg-danger';
                break;
        }

        return $fa;
    }

    public function getAlt(string $type): string
    {
        $alt = '';
        
        switch ($type) {
            case 'com':
                $alt = 'Plante comestible';
                break;
            case 'med':
                $alt = 'Plante médicinale';
                break;
            case 'tox':
                $alt = 'Plante toxique';
                break;
        }

        return $alt;
    }

    public function isToxic(array $categories)
    {
        return in_array('tox', $categories);
    }

    public function getFeatures(PlantFeature $plantFeature)
    {
        return [
            'leaf' => $plantFeature->getLeaf(),
            'rod' => $plantFeature->getRod(),
            'root' => $plantFeature->getRoot(),
            'flower' => $plantFeature->getFlower(),
            'fruct' => $plantFeature->getFruct(),
            'seed' => $plantFeature->getSeed()
        ];
    }
}