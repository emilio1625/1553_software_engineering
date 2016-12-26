<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 19/12/16 08:08 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 19/12/16
 * Time: 08:08 PM
 */


namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="treatment")
 */
class Treatment
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
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor")
     */
    private $doctor;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="treatment")
     */
    private $appointments;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $comments;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @param Patient $patient
     * @param Doctor $doctor
     * @param Appointment $appointment
     */
    public function __construct(Patient $patient, Doctor $doctor, Appointment
        $appointment)
    {
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->appointments = new ArrayCollection();

        $this->addAppointment($appointment);
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
     * @return ArrayCollection|Appointment[]
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * @param Appointment $appointment
     */
    public function addAppointment(Appointment $appointment)
    {
        $this->appointments = $appointment;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
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
