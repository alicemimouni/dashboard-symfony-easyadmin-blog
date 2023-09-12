<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface 
{

    public static function getSubscribedEvents(): array 
    {

        return [
            BeforEntityPersistedEvent::class => ['setEntityDate']
        ];
    }

    public function setEntityDate(BeforeEntityPersistedEvent $event) 
    {
        $entity = $event->getEntityInstance();

        if(!$entity instanceOf TimestampedInterface) {
            return;
        }

        $entity->setDate(new \DateTime());
    }

}