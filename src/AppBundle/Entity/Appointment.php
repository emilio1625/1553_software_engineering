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
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\Range(
     *     min = "now",
     *     max = "+6 months",
     *     minMessage = "Lo lamento, este sistema no escapaz de volver en el tiempo",
     *     maxMessage = "El tiempo máximo de reservación es de 6 meses"
     * )
     * @var \DateTime $startsAt
     */
    private $startsAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startedAt;

    /**
     * @ORM\Column(type="dateinterval")
     * @var \DateInterval $duration
     */
    private $duration;

    /** @var \DateTime $finishesAt */
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
    private $isCanceled = false;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


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

        $this->patient = $patient;
        $patient->addAppointment($this);
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
     * @return \DateInterval
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param \DateInterval $duration
     */
    public function setDuration(\DateInterval $duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return \DateTime
     */
    public function getFinishesAt()
    {
        if (null === $this->finishesAt) {
            $this->finishesAt = clone $this->getStartsAt();
            $this->finishesAt->add($this->getDuration());
        }
        return $this->finishesAt;
    }

    /**
     * @param \DateTime $finishesAt
     */
    public function setFinishesAt($finishesAt)
    {
        if (null === $this->getDuration()) {
            $this->setDuration($this->getStartsAt()->diff($finishesAt));
        }
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

    public function __toString()
    {
        return 'Cita agendada para' . $this->getPatient() . 'con el doctor' . $this->getDoctor()
            . 'para el día' . $this->getStartsAt()->format('d-m-Y H:i');
    }
}
