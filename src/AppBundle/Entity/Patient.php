<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 19/12/16 03:34 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 19/12/16
 * Time: 03:34 PM
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PatientRepository")
 * @ORM\Table(name="patients")
 */
class Patient extends User
{

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $curp;

    /**
     * @ORM\OneToMany(targetEntity="Treatment", mappedBy="patient")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $treatments;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="patient")
     * @ORM\OrderBy({"startsAt" = "DESC", "createdAt" = "DESC"})
     */
    private $appointments;

    /**
     * @ORM\OneToMany(targetEntity="MedicalRecord", mappedBy="patient")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $medicalRecords;

    /**
     * @ORM\OneToMany(targetEntity="Prescription", mappedBy="patient")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $prescriptions;

    /**
     * @ORM\OneToMany(targetEntity="Odontogram", mappedBy="patient")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $odontograms;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;


    public function __construct()
    {
        $this->treatments = new ArrayCollection();
        $this->appointments = new ArrayCollection();
        $this->medicalRecords = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
        $this->odontograms = new ArrayCollection();
        $this->roles[] = 'ROLE_PATIENT';
    }

    /**
     * @return string
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * @param string $curp
     */
    public function setCurp($curp)
    {
        $this->curp = $curp;
    }

    /**
     * @return ArrayCollection|Treatment[]
     */
    public function getTreatments()
    {
        return $this->treatments;
    }

    /**
     * @return Treatment|null
     */
    public function getLastTreatment() {
        return $this->treatments->last();
    }

    /**
     * @param Treatment $treatment
     */
    public function addTreatment(Treatment $treatment)
    {
        if ($this->treatments->contains($treatment)) {
            return;
        }

        $this->treatments->add($treatment);
        $treatment->setPatient($this);
    }

    /**
     * @return ArrayCollection|Appointment[]
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * @return Appointment|null
     */
    public function getNextAppointment() {
        return $this->appointments->last();
    }

    /**
     * @param Appointment $appointment
     */
    public function addAppointment(Appointment $appointment)
    {
        if ($this->appointments->contains($appointment)) {
            return;
        }

        $this->appointments->add($appointment);
        $appointment->setPatient($this);
    }

    /**
     * @return ArrayCollection|MedicalRecord[]
     */
    public function getMedicalRecords()
    {
        return $this->medicalRecords;
    }

    /**
     * @return MedicalRecord|null
     */
    public function getLastMedicalRecord() {
        return $this->medicalRecords->last();
    }

    /**
     * @param MedicalRecord $medicalRecord
     */
    public function addMedicalRecord(MedicalRecord $medicalRecord)
    {
        if ($this->medicalRecords->contains($medicalRecord)) {
            return;
        }

        $this->medicalRecords->add($medicalRecord);
        $medicalRecord->setPatient($this);
    }

    /**
     * @return ArrayCollection|Prescription[]
     */
    public function getPrescriptions()
    {
        return $this->prescriptions;
    }

    /**
     * @return Prescription|null
     */
    public function getLastPrescription() {
        return $this->medicalRecords->last();
    }

    /**
     * @param Prescription $prescription
     */
    public function addPrescription(Prescription $prescription)
    {
        if ($this->prescriptions->contains($prescription)) {
            return;
        }

        $this->prescriptions->add($prescription);
        $prescription->setPatient($this);
    }

    /**
     * @return ArrayCollection|Odontogram[]
     */
    public function getOdontograms()
    {
        return $this->odontograms;
    }

    /**
     * @return Odontogram|null
     */
    public function getLastOdontogram() {
        return $this->odontograms->first();
    }

    /**
     * @param Odontogram $odontogram
     */
    public function addOdontogram(Odontogram $odontogram)
    {
        if ($this->odontograms->contains($odontogram)) {
            return;
        }

        $this->odontograms->add($odontogram);
        $odontogram->setPatient($this);
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    public function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }
}
