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
     * @ORM\ManyToMany(targetEntity="Doctor", mappedBy="patients")
     */
    private $doctors;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $curp;

    /**
     * @ORM\OneToMany(targetEntity="MedicalRecord", mappedBy="patient")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $medicalRecords;

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
     * @ORM\OneToMany(targetEntity="Odontogram", mappedBy="patient")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $odontograms;

    /**
     * @ORM\Column(type="text")
     */
    private $note;


    /**
     * @param
     */
    public function __construct()
    {
        $this->doctors = new ArrayCollection();
        $this->medicalRecords = new ArrayCollection();
        $this->treatments = new ArrayCollection();
        $this->appointments = new ArrayCollection();
        $this->odontograms = new ArrayCollection();
    }


    /**
     * @return ArrayCollection|Doctor[]
     */
    public function getDoctors()
    {
        return $this->doctors;
    }

    /**
     * @param Doctor $doctor
     * @return boolean
     */
    public function addDoctor(Doctor $doctor)
    {
        return $this->doctors->add($doctor);
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
        return $this->medicalRecords->add($medicalRecord);
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
    public function addTreatments(Treatment $treatment)
    {
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
        return $this->appointments->add($appointment);
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
     * @return booleaan
     */
    public function addOdontogram(Odontogram $odontogram)
    {
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