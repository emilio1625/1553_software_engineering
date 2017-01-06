<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 23/12/16 04:17 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 23/12/16
 * Time: 04:17 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Patient;
use Doctrine\ORM\EntityRepository;


class PatientRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return array
     */
    public function findNameLike($name)
    {
        return $this
            ->createQueryBuilder('patient')
            ->where('patient.firstName LIKE :name')
            ->orWhere('patient.lastName LIKE :name')
            ->orWhere('patient.username LIKE :name')
            ->orWhere('patient.email LIKE :name')
            ->orWhere('patient.curp LIKE :name')
            ->setParameter('name', "%$name%")
            ->orderBy('patient.lastName')
            ->setMaxResults(10)
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @param Patient $patient
     * @param bool   $flush
     */
    public function add(Patient $patient, $flush = false)
    {
        $this->getEntityManager()->persist($patient);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
