<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 19/12/16 08:09 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 19/12/16
 * Time: 08:09 PM
 */

namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="medical_record")
 */
class MedicalRecord
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
     * @ORM\OneToOne(targetEntity="Appointment", inversedBy="medicalRecord")
     */
    private $appointment;

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

    // Physical Exam
    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $bloodPreasure;

    // Non Pathological Background
    /**
     * @ORM\Column(type="string")
     */
    private $alergies;

    /**
     * @ORM\Column(type="string")
     */
    private $job;

    /**
     * @ORM\Column(type="string")
     */
    private $maritalStatus;

    /**
     * @ORM\Column(type="string")
     */
    private $religion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAlcholic;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSmoker;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDrugAddict;

    // Pathological Background
    /**
     * @ORM\Column(type="boolean")
     */
    private $hasDiabetes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasHeartDiseases;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasAsma;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasHearingImpairment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasEyesightImpairment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasSpeechIpariment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasMusculoskeletalDisorders;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasEpilepsy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasSinusitis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasPhysicalRestictions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasKidneyIllness;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasMentalDisorders;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasHypertension;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasArthritis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasNoseBleeds;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasMenstrualClamps;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasBleedingDisorders;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasIntestinalDisorders;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasEatingDisorders;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasHeadeaches;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasRecentSurgery;

    // Doctor Observations
    /**
     * @ORM\Column(type="text")
     */
    private $observations;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @param $patient
     * @param $doctor
     * @param $appointment
     */
    public function __construct(Patient $patient,
        Doctor $doctor, Appointment $appointment)
    {
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->appointment = $appointment;
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
     * @return Appointment
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * @param Appointment $appointment
     */
    public function setAppointment(Appointment $appointment)
    {
        $this->appointment = $appointment;
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
        $this->doctor = $doctor;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getBloodPreasure()
    {
        return $this->bloodPreasure;
    }

    /**
     * @param float $bloodPreasure
     */
    public function setBloodPreasure($bloodPreasure)
    {
        $this->bloodPreasure = $bloodPreasure;
    }

    /**
     * @return string
     */
    public function getAlergies()
    {
        return $this->alergies;
    }

    /**
     * @param string $alergies
     */
    public function setAlergies($alergies)
    {
        $this->alergies = $alergies;
    }

    /**
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setJob($job)
    {
        $this->job = $job;
    }

    /**
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param string $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return string
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param string $religion
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    /**
     * @return boolean
     */
    public function getIsAlcholic()
    {
        return $this->isAlcholic;
    }

    /**
     * @param boolean $isAlcholic
     */
    public function setIsAlcholic($isAlcholic)
    {
        $this->isAlcholic = $isAlcholic;
    }

    /**
     * @return boolean
     */
    public function getIsSmoker()
    {
        return $this->isSmoker;
    }

    /**
     * @param boolean $isSmoker
     */
    public function setIsSmoker($isSmoker)
    {
        $this->isSmoker = $isSmoker;
    }

    /**
     * @return boolean
     */
    public function getIsDrugAddict()
    {
        return $this->isDrugAddict;
    }

    /**
     * @param boolean $isDrugAddict
     */
    public function setIsDrugAddict($isDrugAddict)
    {
        $this->isDrugAddict = $isDrugAddict;
    }

    /**
     * @return boolean
     */
    public function getHasDiabetes()
    {
        return $this->hasDiabetes;
    }

    /**
     * @param boolean $hasDiabetes
     */
    public function setHasDiabetes($hasDiabetes)
    {
        $this->hasDiabetes = $hasDiabetes;
    }

    /**
     * @return boolean
     */
    public function getHasHeartDiseases()
    {
        return $this->hasHeartDiseases;
    }

    /**
     * @param boolean $hasHeartDiseases
     */
    public function setHasHeartDiseases($hasHeartDiseases)
    {
        $this->hasHeartDiseases = $hasHeartDiseases;
    }

    /**
     * @return boolean
     */
    public function getHasAsma()
    {
        return $this->hasAsma;
    }

    /**
     * @param boolean $hasAsma
     */
    public function setHasAsma($hasAsma)
    {
        $this->hasAsma = $hasAsma;
    }

    /**
     * @return boolean
     */
    public function getHasHearingImpairment()
    {
        return $this->hasHearingImpairment;
    }

    /**
     * @param boolean $hasHearingImpairment
     */
    public function setHasHearingImpairment($hasHearingImpairment)
    {
        $this->hasHearingImpairment = $hasHearingImpairment;
    }

    /**
     * @return boolean
     */
    public function getHasEyesightImpairment()
    {
        return $this->hasEyesightImpairment;
    }

    /**
     * @param boolean $hasEyesightImpairment
     */
    public function setHasEyesightImpairment($hasEyesightImpairment)
    {
        $this->hasEyesightImpairment = $hasEyesightImpairment;
    }

    /**
     * @return boolean
     */
    public function getHasSpeechIpariment()
    {
        return $this->hasSpeechIpariment;
    }

    /**
     * @param boolean $hasSpeechIpariment
     */
    public function setHasSpeechIpariment($hasSpeechIpariment)
    {
        $this->hasSpeechIpariment = $hasSpeechIpariment;
    }

    /**
     * @return boolean
     */
    public function getHasMusculoskeletalDisorders()
    {
        return $this->hasMusculoskeletalDisorders;
    }

    /**
     * @param boolean $hasMusculoskeletalDisorders
     */
    public function setHasMusculoskeletalDisorders($hasMusculoskeletalDisorders)
    {
        $this->hasMusculoskeletalDisorders = $hasMusculoskeletalDisorders;
    }

    /**
     * @return boolean
     */
    public function getHasEpilepsy()
    {
        return $this->hasEpilepsy;
    }

    /**
     * @param boolean $hasEpilepsy
     */
    public function setHasEpilepsy($hasEpilepsy)
    {
        $this->hasEpilepsy = $hasEpilepsy;
    }

    /**
     * @return boolean
     */
    public function getHasSinusitis()
    {
        return $this->hasSinusitis;
    }

    /**
     * @param boolean $hasSinusitis
     */
    public function setHasSinusitis($hasSinusitis)
    {
        $this->hasSinusitis = $hasSinusitis;
    }

    /**
     * @return boolean
     */
    public function getHasPhysicalRestictions()
    {
        return $this->hasPhysicalRestictions;
    }

    /**
     * @param boolean $hasPhysicalRestictions
     */
    public function setHasPhysicalRestictions($hasPhysicalRestictions)
    {
        $this->hasPhysicalRestictions = $hasPhysicalRestictions;
    }

    /**
     * @return boolean
     */
    public function getHasKidneyIllness()
    {
        return $this->hasKidneyIllness;
    }

    /**
     * @param boolean $hasKidneyIllness
     */
    public function setHasKidneyIllness($hasKidneyIllness)
    {
        $this->hasKidneyIllness = $hasKidneyIllness;
    }

    /**
     * @return boolean
     */
    public function getHasMentalDisorders()
    {
        return $this->hasMentalDisorders;
    }

    /**
     * @param boolean $hasMentalDisorders
     */
    public function setHasMentalDisorders($hasMentalDisorders)
    {
        $this->hasMentalDisorders = $hasMentalDisorders;
    }

    /**
     * @return boolean
     */
    public function getHasHypertension()
    {
        return $this->hasHypertension;
    }

    /**
     * @param boolean $hasHypertension
     */
    public function setHasHypertension($hasHypertension)
    {
        $this->hasHypertension = $hasHypertension;
    }

    /**
     * @return boolean
     */
    public function getHasArthritis()
    {
        return $this->hasArthritis;
    }

    /**
     * @param boolean $hasArthritis
     */
    public function setHasArthritis($hasArthritis)
    {
        $this->hasArthritis = $hasArthritis;
    }

    /**
     * @return boolean
     */
    public function getHasNoseBleeds()
    {
        return $this->hasNoseBleeds;
    }

    /**
     * @param boolean $hasNoseBleeds
     */
    public function setHasNoseBleeds($hasNoseBleeds)
    {
        $this->hasNoseBleeds = $hasNoseBleeds;
    }

    /**
     * @return boolean
     */
    public function getHasMenstrualClamps()
    {
        return $this->hasMenstrualClamps;
    }

    /**
     * @param boolean $hasMenstrualClamps
     */
    public function setHasMenstrualClamps($hasMenstrualClamps)
    {
        $this->hasMenstrualClamps = $hasMenstrualClamps;
    }

    /**
     * @return boolean
     */
    public function getHasBleedingDisorders()
    {
        return $this->hasBleedingDisorders;
    }

    /**
     * @param boolean $hasBleedingDisorders
     */
    public function setHasBleedingDisorders($hasBleedingDisorders)
    {
        $this->hasBleedingDisorders = $hasBleedingDisorders;
    }

    /**
     * @return boolean
     */
    public function getHasIntestinalDisorders()
    {
        return $this->hasIntestinalDisorders;
    }

    /**
     * @param boolean $hasIntestinalDisorders
     */
    public function setHasIntestinalDisorders($hasIntestinalDisorders)
    {
        $this->hasIntestinalDisorders = $hasIntestinalDisorders;
    }

    /**
     * @return boolean
     */
    public function getHasEatingDisorders()
    {
        return $this->hasEatingDisorders;
    }

    /**
     * @param boolean $hasEatingDisorders
     */
    public function setHasEatingDisorders($hasEatingDisorders)
    {
        $this->hasEatingDisorders = $hasEatingDisorders;
    }

    /**
     * @return boolean
     */
    public function getHasHeadeaches()
    {
        return $this->hasHeadeaches;
    }

    /**
     * @param boolean $hasHeadeaches
     */
    public function setHasHeadeaches($hasHeadeaches)
    {
        $this->hasHeadeaches = $hasHeadeaches;
    }

    /**
     * @return boolean
     */
    public function getHasRecentSurgery()
    {
        return $this->hasRecentSurgery;
    }

    /**
     * @param boolean $hasRecentSurgery
     */
    public function setHasRecentSurgery($hasRecentSurgery)
    {
        $this->hasRecentSurgery = $hasRecentSurgery;
    }

    /**
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param string $observations
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;
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