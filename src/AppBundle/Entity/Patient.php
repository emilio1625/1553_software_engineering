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


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


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
     * @ORM\Column(type="text")
     */
    private $note;


    public function __construct()
    {
        $this->doctors = new ArrayCollection();
        $this->treatments = new ArrayCollection();
        $this->appointments = new ArrayCollection();
        $this->medicalRecords = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
        $this->odontograms = new ArrayCollection();
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
        return $this->treatments->first();
    }

    /**
     * @param Treatment $treatment
     * @return boolean
     */
    public function addTreatment(Treatment $treatment)
    {
        if ($this->treatments->contains($treatment)) {
            return true;
        }

        $treatment->setPatient($this);
        return $this->treatments->add($treatment);
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
        return $this->appointments->first();
    }

    /**
     * @param Appointment $appointment
     * @return boolean
     */
    public function addAppointment(Appointment $appointment)
    {
        if ($this->appointments->contains($appointment)) {
            return true;
        }

        $appointment->setPatient($this);
        return $this->appointments->add($appointment);
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
        return $this->medicalRecords->first();
    }

    /**
     * @param MedicalRecord $medicalRecord
     * @return boolean
     */
    public function addMedicalRecord(MedicalRecord $medicalRecord)
    {
        if ($this->medicalRecords->contains($medicalRecord)) {
            return true;
        }

        $medicalRecord->setPatient($this);
        return $this->medicalRecords->add($medicalRecord);
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
        return $this->medicalRecords->first();
    }

    /**
     * @param Prescription $prescription
     * @return boolean
     */
    public function addPrescription(Prescription $prescription)
    {
        if ($this->prescriptions->contains($prescription)) {
            return true;
        }

        $prescription->setPatient($this);
        return $this->prescriptions->add($prescription);
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
     * @return boolean
     */
    public function addOdontogram(Odontogram $odontogram)
    {
        if ($this->odontograms->contains($odontogram)) {
            return true;
        }

        $odontogram->setPatient($this);
        return $this->odontograms->add($odontogram);
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
}
