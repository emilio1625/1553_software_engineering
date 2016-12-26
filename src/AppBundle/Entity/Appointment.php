<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 21/12/16 03:44 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 21/12/16
 * Time: 03:44 PM
 */

namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="appointment")
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Slug(fields={"id"})
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Patient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\OneToOne(targetEntity="MedicalRecord", mappedBy="appointment")
     */
    private $medicalRecord;

    /**
     * @ORM\OneToOne(targetEntity="Odontogram", mappedBy="appointment")
     */
    private $odontogram;

    /**
     * @ORM\ManyToOne(targetEntity="Treatment", inversedBy="appointments")
     */
    private $treatment;

    /**
     * @ORM\OneToOne(targetEntity="Prescription", mappedBy="appointment")
     */
    private $prescription;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startsAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finishesAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finishedAt;

    /**
     * @ORM\Column(type="text")
     */
    private $notes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCanceled;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @param $patient
     * @param $doctor
     * @param $treatment
     * @param $startsAt
     * @param $finishesAt
     */
    public function __construct(
        Patient $patient,
        Doctor $doctor,
        Treatment $treatment = null,
        \DateTime $startsAt,
        \DateTime $finishesAt
    ) {
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->treatment = $treatment;
        $this->startsAt = $startsAt;
        $this->finishesAt = $finishesAt;
        $this->isCanceled = false;
    }


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @return Doctor
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @return MedicalRecord
     */
    public function getMedicalRecord()
    {
        return $this->medicalRecord;
    }

    /**
     * @param MedicalRecord $medicalRecord
     */
    public function setMedicalRecord($medicalRecord)
    {
        $this->medicalRecord = $medicalRecord;
    }

    /**
     * @return Odontogram
     */
    public function getOdontogram()
    {
        return $this->odontogram;
    }

    /**
     * @param Odontogram $odontogram
     */
    public function setOdontogram($odontogram)
    {
        $this->odontogram = $odontogram;
    }

    /**
     * @return Treatment
     */
    public function getTreatment()
    {
        return $this->treatment;
    }

    /**
     * @param Treatment $treatment
     */
    public function setTreatment($treatment)
    {
        $this->treatment = $treatment;
    }

    /**
     * @return Prescription
     */
    public function getPrescription()
    {
        return $this->prescription;
    }

    /**
     * @param Prescription $prescription
     */
    public function setPrescription($prescription)
    {
        $this->prescription = $prescription;
    }

    /**
     * @return \DateTime
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * @param \DateTime $startsAt
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTime $startedAt
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @return \DateTime
     */
    public function getFinishesAt()
    {
        return $this->finishesAt;
    }

    /**
     * @param \DateTime $finishesAt
     */
    public function setFinishesAt($finishesAt)
    {
        $this->finishesAt = $finishesAt;
    }

    /**
     * @return \DateTime
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * @param \DateTime $finishedAt
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return boolean
     */
    public function getIsCanceled()
    {
        return $this->isCanceled;
    }

    /**
     * @param boolean $isCanceled
     */
    public function setIsCanceled($isCanceled)
    {
        $this->isCanceled = $isCanceled;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


}
