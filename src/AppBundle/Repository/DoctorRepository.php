<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 31/12/16 05:46 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 31/12/16
 * Time: 05:46 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Doctor;
use Doctrine\ORM\EntityRepository;


class DoctorRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return array
     */
    public function findNameLike($name)
    {
        return $this
            ->createQueryBuilder('doctor')
            ->where('doctor.firstName LIKE :name')
            ->orWhere('doctor.lastName LIKE :name')
            ->orWhere('doctor.specialty LIKE :name')
            ->orWhere('doctor.email LIKE :name')
            ->orWhere('doctor.username LIKE :name')
            ->setParameter('name', "%$name%")
            ->orderBy('doctor.lastName')
            ->setMaxResults(10)
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @param Doctor $doctor
     * @param bool   $flush
     */
    public function add(Doctor $doctor, $flush = false)
    {
        $this->getEntityManager()->persist($doctor);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
