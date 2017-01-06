<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 19/12/16 10:22 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 19/12/16
 * Time: 10:22 PM
 */

namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="prescription")
 */
class Prescription
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
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="prescriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\OneToOne(targetEntity="MedicalRecord", inversedBy="prescription")
     */
    private $medicalRecord;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message="El diagnostico no puede estar vacío"
     * )
     */
    private $rx;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message="Las recomendaciones no pueden estar vacías"
     * )
     */
    private $recommendations;

    /**
     * @ORM\Column(type="text")
     */
    private $notes;

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
        $patient->addPrescription($this);
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

        $this->medicalRecord = $medicalRecord;
        $medicalRecord->setPrescription($this);
    }

    /**
     * @return string
     */
    public function getRx()
    {
        return $this->rx;
    }

    /**
     * @param string $rx
     */
    public function setRx($rx)
    {
        $this->rx = $rx;
    }

    /**
     * @return string
     */
    public function getRecommendations()
    {
        return $this->recommendations;
    }

    /**
     * @param string $recommendations
     */
    public function setRecommendations($recommendations)
    {
        $this->recommendations = $recommendations;
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
