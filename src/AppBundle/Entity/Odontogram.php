<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 21/12/16 03:39 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 21/12/16
 * Time: 03:39 PM
 */

namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="odontogram")
 */
class Odontogram
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\OneToOne(targetEntity="Appointment", inversedBy="odontogram")
     */
    private $appointment;

    /**
     * @ORM\Column(type="array")
     */
    private $odontogram;


    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @param Patient $patient
     * @param Appointment $appointment
     */
    public function __construct(Patient $patient, Appointment$appointment)
    {
        $this->patient = $patient;
        $this->appointment = $appointment;
        $this->odontogram = [
            'maxilla' => [
                'primary' => [
                    '11' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '12' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '13' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '14' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '15' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '16' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '17' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '18' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],

                    '21' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '22' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '23' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '24' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '25' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '26' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '27' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '28' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ]
                ],
                'secondary' => [
                    '51' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '52' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '53' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '54' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '55' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],

                    '61' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '62' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '63' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '64' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '65' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                ]
            ],
            'mandible' => [
                'primary' => [
                    '31' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '32' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '33' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '34' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '35' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '36' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '37' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '38' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],

                    '41' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '42' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '43' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '44' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '45' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '46' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '47' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '48' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ]
                ],
                'secondary' => [
                    '71' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '72' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '73' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '74' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '75' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],

                    '81' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '82' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '83' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '84' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                    '85' => [
                        'right' => '',
                        'left' => '',
                        'top' => '',
                        'bottom' => '',
                        'center' => ''
                    ],
                ]
            ]
        ];

        $lastOdontogram = $this->patient->getLastOdontogram();
        if ($lastOdontogram) {
            $this->odontogram = $lastOdontogram->getOdontogram();
        }
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
        $patient->addOdontogram($this);
        $this->patient = $patient;
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
     * @return array
     */
    public function getOdontogram()
    {
        return $this->odontogram;
    }

    /**
     * @param array $odontogram
     */
    public function setOdontogram(array $odontogram)
    {
        $this->odontogram = $odontogram;
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
