<?php

namespace App\EventListener;

use App\Entity\Play;
use App\Entity\User;
use App\Entity\Card;
use App\Entity\Game;
use App\Entity\Money;
use App\Entity\Profile;
use App\Entity\Comment;
use App\Entity\CardPattern;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DatabaseActivitySubscriber implements EventSubscriber
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {

            $encoded = $this->encoder->encodePassword($entity, $entity->getPassword());
            //$encoded = $entity->getPassword();
            $entity->setPassword($encoded);

            //$entity->setPassword(uniqid());
            $entity->setIsActive(true);
            $entity->setIsEnabled(true);
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());

            return;
        }

        if ($entity instanceof Profile) {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
            return;
        }

        if ($entity instanceof Comment) {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
            return;
        }

        if ($entity instanceof TiktokjFeed) {
            $entity->setUuidX(uniqid());
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {

            $entity->setUpdatedAt(new \DateTime());

            return;
        }

        if ($entity instanceof Profile) {

            $entity->setUpdatedAt(new \DateTime());

            return;
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->logActivity('persist', $args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->logActivity('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->logActivity('update', $args);
    }

    private function logActivity(string $action, LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this subscriber only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Money) {
            return;
        }

        // ... get the entity information and log it somehow
    }
}