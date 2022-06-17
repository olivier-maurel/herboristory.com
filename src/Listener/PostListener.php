<?php

namespace App\Listener;

use App\Entity\Plant;
use App\Entity\Post;
use Doctrine\ORM\Event\LifecycleEventArgs;
use \Symfony\Component\DependencyInjection\Container;

class PostListener
{

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function prePersist(Post $post, LifecycleEventArgs $event)
    {
        if (!$post instanceof Post)
            return;

        // $entityManager = $event->getObjectManager();

        $post->setCreatedAt(new \DateTime());
        $post->setSlug($event->getObject()->getTitle());
        
    }
}