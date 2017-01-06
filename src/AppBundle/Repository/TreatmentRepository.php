<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 5/01/17 12:08 AM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 5/01/17
 * Time: 12:08 AM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Patient;
use Doctrine\ORM\EntityRepository;


class TreatmentRepository extends EntityRepository
{
    public function createByPatientQueryBuilder(Patient $patient)
    {
        return $this->createQueryBuilder('treatment')
            ->where('treatment.patient = :patient')
            ->andWhere('treatment.isFinished = 0')
            ->orderBy('treatment.createdAt', 'DESC')
            ->setParameter('patient', $patient);
    }
}
