<?php
namespace App\Extension;

use App\Entity\PlantAttribute;
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
            new TwigFilter('getAttrRender', [$this, 'getAttrRender']),
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

    public function getAttrRender(PlantAttribute $attribute)
    {
        $icon = $attribute->getIcon();
        $value = $attribute->getValue();
        $type = strtolower($attribute->getType());
        $label = $attribute->getLabel();
        $color = $attribute->getColor();

        if (!is_null($icon))
            $icon = "<i class=\"fa $icon\" style=\"color: $color\"></i>";
        
        if ($type == 'color')
            $icon = "<div class=\"img-round-xs\" style=\"background-color: $color;\"></div>";

        $label = "<span style=\"color: $color\">$label</span>";
        $result = "<label class=\"label-$type\">$icon $label</label>";

        return $result;
    }
}