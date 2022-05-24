<?php
namespace App\Extension;

use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MainExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            // new TwigFilter('getIcon', [$this, 'getIcon']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('setReferer', [$this, 'setReferer']),
        ];
    }

    public function setReferer(Request $request): string
    {
        $host = $request->server->get('HTTP_HOST');

        if ($request->headers->get('referer') !== null) {
            
            $referer = explode('/', $request->headers->get('referer'));
            
            if ($referer[2] === $host)
                return $request->headers->get('referer');
        }
        
        return('http://'.$host.'/search');
    }

}