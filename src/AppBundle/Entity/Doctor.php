<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 19/12/16 08:07 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 19/12/16
 * Time: 08:07 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="doctor")
 */
class Doctor extends User
{
    /**
     * @ORM\Column(type="string")
     */
    private $specialty;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $professionalId;

    /**
     * @ORM\ManyToMany(targetEntity="Patient", inversedBy="doctors")
     */
    private $patients;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="doctor")
     * @ORM\OrderBy({"startsAt" = "DESC", "createdAt" = "DESC"})
     */
    private $appointments;

    /**
     * @ORM\Column(type="time")
     */
    private $workHoursStart;

    /**
     * @ORM\Column(type="time")
     */
    private $workHoursEnd;

    /**
     * @ORM\Column(type="time")
     */
    private $lunchStart;

    /**
     * @ORM\Column(type="time")
     */
    private $lunchEnd;

    /**
     * @ORM\Column(type="string")
     */
    private $workDaysStart;

    /**
     * @ORM\Column(type="string")
     */
    private $workDaysEnd;

    /**
     * @ORM\Column(type="text")
     */
    private $semblance;


    /**
     * @param
     */
    public function __construct()
    {
        $this->patients = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getSpecialty()
    {
        return $this->specialty;
    }

    /**
     * @param string $specialty
     */
    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;
    }

    /**
     * @return string
     */
    public function getProfessionalId()
    {
        return $this->professionalId;
    }

    /**
     * @param string $professionalId
     */
    public function setProfessionalId($professionalId)
    {
        $this->professionalId = $professionalId;
    }

    /**
     * @return ArrayCollection|Patient[]
     */
    public function getPatients()
    {
        return $this->patients;
    }

    /**
     * @param Patient $patient
     * @return boolean
     */
    public function addPatient(Patient $patient)
    {
        return $this->patients->add($patient);
    }

    /**
     * @return ArrayCollection|Appointment[]
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * @return Appointment
     */
    public function getNextAppointment()
    {
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
     * @return \DateTime
     */
    public function getWorkHoursStart()
    {
        return $this->workHoursStart;
    }

    /**
     * @param \DateTime $workHoursStart
     */
    public function setWorkHoursStart(\DateTime $workHoursStart)
    {
        $this->workHoursStart = $workHoursStart;
    }

    /**
     * @return \DateTime
     */
    public function getWorkHoursEnd()
    {
        return $this->workHoursEnd;
    }

    /**
     * @param \DateTime $workHoursEnd
     */
    public function setWorkHoursEnd(\DateTime $workHoursEnd)
    {
        $this->workHoursEnd = $workHoursEnd;
    }

    /**
     * @return \DateTime
     */
    public function getLunchStart()
    {
        return $this->lunchStart;
    }

    /**
     * @param \DateTime $lunchStart
     */
    public function setLunchStart(\DateTime $lunchStart)
    {
        $this->lunchStart = $lunchStart;
    }

    /**
     * @return \DateTime
     */
    public function getLunchEnd()
    {
        return $this->lunchEnd;
    }

    /**
     * @param \DateTime $lunchEnd
     */
    public function setLunchEnd(\DateTime $lunchEnd)
    {
        $this->lunchEnd = $lunchEnd;
    }

    /**
     * @return string
     */
    public function getWorkDaysStart()
    {
        return $this->workDaysStart;
    }

    /**
     * @param string $workDaysStart
     */
    public function setWorkDaysStart($workDaysStart)
    {
        $this->workDaysStart = $workDaysStart;
    }

    /**
     * @return string
     */
    public function getWorkDaysEnd()
    {
        return $this->workDaysEnd;
    }

    /**
     * @param string $workDaysEnd
     */
    public function setWorkDaysEnd($workDaysEnd)
    {
        $this->workDaysEnd = $workDaysEnd;
    }

    /**
     * @return string
     */
    public function getSemblance()
    {
        return $this->semblance;
    }

    /**
     * @param string $semblance
     */
    public function setSemblance($semblance)
    {
        $this->semblance = $semblance;
    }

}
