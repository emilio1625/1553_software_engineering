<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 30/12/16 04:14 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 30/12/16
 * Time: 04:14 PM
 */

namespace AppBundle\Doctrine;


use AppBundle\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class HashPasswordListener implements EventSubscriber
{
    /** @var UserPasswordEncoder */
    private $passwordEncoder;


    public function __construct(UserPasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!($entity instanceof User)) {
            return;
        }

        if (!$entity->getPlainPassword()) {
            return;
        }

        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!($entity instanceof User)) {
            return;
        }

        if (!$entity->getPlainPassword()) {
            return;
        }

        $this->encodePassword($entity);

        // telling doctrine that password has just been changed
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * @param User $entity
     */
    public function encodePassword(User $entity)
    {
        $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encoded);
    }
}
