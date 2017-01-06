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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoctorRepository")
 * @ORM\Table(name="doctor")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class Doctor extends User
{
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     *     message="La especilidad no puede estar vacía"
     * )
     */
    private $specialty;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Regex(
     *     pattern = "/\d/",
     *     message = "Número de cédula no válido"
     * )
     */
    private $professionalId;

    /**
     * @ORM\ManyToMany(targetEntity="Patient", cascade={"persist"})
     */
    private $patients;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="doctor")
     * @ORM\OrderBy({"startsAt" = "DESC", "createdAt" = "DESC"})
     */
    private $appointments;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(
     *     choices = {"lunes", "martes", "miércoles", "jueves", "viernes", "sábado", "domingo"},
     *     message = "No es un día válido"
     * )
     */
    private $dayOff;

    /**
     * @ORM\Column(type="time")
     * @Assert\Time(
     *     message="No es una hora valida"
     * )
     * @var \DateTime $checkInTime
     */
    private $checkInTime;

    /**
     * @ORM\Column(type="dateinterval")
     * @var \DateInterval $workHours
     */
    private $workHours;

    /**
     * @ORM\Column(type="time")
     * @Assert\Time(
     *     message="No es una hora valida"
     * )
     * @var \DateTime
     */
    private $breakTime;

    /**
     * @ORM\Column(type="dateinterval")
     * @var \DateInterval $breakDuration
     */
    private $breakDuration;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message = "La semblanza no puede estar vacía"
     * )
     */
    private $semblance;


    public function __construct()
    {
        $this->patients = new ArrayCollection();
        $this->appointments = new ArrayCollection();
        $this->roles[] = 'ROLE_DOCTOR';
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
     */
    public function addPatients(Patient $patient)
    {
        if ($this->patients->contains($patient)) {
            return;
        }

        $this->patients->add($patient);
    }

    /**
     * @param ArrayCollection|Patient[] $patients
     */
    public function setPatients($patients)
    {
        $this->patients = $patients;
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
        return $this->appointments->last();
    }

    /**
     * @param Appointment $appointment
     * @return boolean
     */
    public function addAppointment(Appointment $appointment)
    {
        if ($this->appointments->contains($appointment)) {
            return;
        }

        $this->appointments->add($appointment);
        $appointment->setDoctor($this);
    }

    /**
     * @return mixed
     */
    public function getDayOff()
    {
        return $this->dayOff;
    }

    /**
     * @param mixed $dayOff
     */
    public function setDayOff($dayOff)
    {
        $this->dayOff = $dayOff;
    }

    /**
     * @return \DateTime
     */
    public function getCheckInTime()
    {
        return $this->checkInTime;
    }

    /**
     * @param \DateTime $checkInTime
     */
    public function setCheckInTime(\DateTime $checkInTime)
    {
        $this->checkInTime = $checkInTime;
    }

    /**
     * @return \DateInterval
     */
    public function getWorkHours()
    {
        return $this->workHours;
    }

    /**
     * @param \DateInterval $workHours
     */
    public function setWorkHours(\DateInterval $workHours)
    {
        $this->workHours = $workHours;
    }

    /**
     * @return \DateTime
     */
    public function getBreakTime()
    {
        return $this->breakTime;
    }

    /**
     * @param \DateTime $breakTime
     */
    public function setBreakTime(\DateTime $breakTime)
    {
        $this->breakTime = $breakTime;
    }

    /**
     * @return \DateInterval
     */
    public function getBreakDuration()
    {
        return $this->breakDuration;
    }

    /**
     * @param \DateInterval $breakDuration
     */
    public function setBreakDuration(\DateInterval $breakDuration)
    {
        $this->breakDuration = $breakDuration;
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

    public function __toString()
    {
        return $this->firstName.' '.$this->lastName.': '.$this->specialty;
    }


    /**
     * @param Appointment $newAppointment
     * @return boolean
     */
    public function isAvailable(Appointment $newAppointment)
    {

        $days = [
            'lunes' => 'Monday',
            'martes' => 'Tuesday',
            'miércoles' => 'Wednesday',
            'jueves' => 'Thursday',
            'viernes' => 'Friday',
            'sábado' => 'Saturday',
            'domingo' => 'Sunday'
        ];
        $now = new \DateTime();
        $start2 = clone $newAppointment->getStartsAt();

        if ($start2->format('l') === $days[$this->getDayOff()]) { // es su dia de descanso?
            return false;
        }

        $start1 = $this->getCheckInTime()->format('H:i:s');
        $temp = clone $this->getBreakTime();
        $end1 = $temp->format('H:i:s');
        $start2 = $start2->format('H:i:s');
        $end2 = $newAppointment->getFinishesAt()->format('H:i:s');
        if (!($start1 < $start2 && $end1 > $end2)) { // no entre su hora de entrada y su hora de comida
            $start1 = $temp->format('H:i:s');
            $temp->add($this->getBreakDuration());
            $end1 = $temp->format('H:i:s');
            if ($start1 < $end2 && $end1 > $start2) { // si esta en su hora de comida
                return false;
            }
            $start1 = $temp->format('H:i:s');
            $temp = clone $this->getCheckInTime(); $temp->add($this->getWorkHours());
            $end1 = $temp->format('H:i:s');
            if (!($start1 < $start2 && $end1 > $end2)) { // si no esta entre su entrada y su hora de comida
                return false;
            }
        }

        $start2 = $newAppointment->getStartsAt();
        $end2 = $newAppointment->getFinishesAt();

        foreach ($this->getAppointments() as $appointment) {
            if ($appointment === $newAppointment || $appointment->getIsCanceled()
                || $appointment->getFinishesAt() < $now) {
                continue;
            }
            $start1 = $appointment->getStartsAt();
            $end1 = $appointment->getFinishesAt();
            if (($start1 < $end2) && ($end1 > $start2)) { // si se sobreponen
                return false;
            }
        }

        return true;
    }
}
