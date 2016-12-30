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
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="appointments")
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
     * @param Patient $patient
     */
    public function setPatient(Patient $patient)
    {
        if ($patient === $this->patient) {
            return;
        }

        $patient->addAppointment($this);
        $this->patient = $patient;
    }

    /**
     * @return Doctor
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @param Doctor $doctor
     */
    public function setDoctor(Doctor $doctor)
    {
        if ($doctor === $this->doctor) {
            return;
        }

        $this->doctor = $doctor;
        $doctor->addAppointment($this);
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
    public function setMedicalRecord(MedicalRecord $medicalRecord)
    {
        if ($medicalRecord === $this->medicalRecord) {
            return;
        }

        $medicalRecord->setAppointment($this);
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
    public function setOdontogram(Odontogram $odontogram)
    {
        if ($odontogram === $this->odontogram) {
            return;
        }

        $odontogram->setAppointment($this);
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
    public function setTreatment(Treatment $treatment)
    {
        if ($treatment == $this->treatment) {
            return;
        }

        $this->treatment = $treatment;
        $treatment->addAppointment($this);
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
    public function setPrescription(Prescription $prescription)
    {
        if ($prescription === $this->prescription) {
            return;
        }

        $this->prescription = $prescription;
        $prescription->setAppointment($this);
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
    public function setStartsAt(\DateTime $startsAt)
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
    public function setStartedAt(\DateTime $startedAt)
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
    public function setFinishesAt(\DateTime $finishesAt)
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
    public function setFinishedAt(\DateTime $finishedAt)
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
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }


}
