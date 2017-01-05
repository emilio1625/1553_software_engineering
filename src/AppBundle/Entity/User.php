<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 19/12/16 04:07 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 19/12/16
 * Time: 04:07 PM
 */

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;


/**
 * @ORM\InheritanceType("TABLE_PER_CLASS")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank(message="El nombre de usuario no puede estar en blanco")
     * @Assert\Length(
     *     min="4",
     *     minMessage="El nombre de usuario debe tener mínimo {{ limit }} caracteres",
     *     max="12",
     *     maxMessage="El nombre de usuario no puede ser mayor a {{ limit }} caracteres"
     * )
     */
    protected $username;

    /**
     * @Gedmo\Slug(fields={"username"})
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * Used to create and change the user's password
     * @var string
     * @Assert\NotBlank(groups={"Registration"})
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    protected $roles = [];

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern = "\[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{1,50}\",
     *     message = "Nombre no válido"
     * )
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern="\[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{1,50}\",
     *     message="Apellidos no válidos"
     * )
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email(
     *     strict = true,
     *     checkMX = true,
     *     checkHost = true,
     *     message = "Email no válido"
     * )
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(
     *     choices = {"hombre", "mujer", "otro"},
     *     message = "Opcion inválida, elige un genero válido"
     * )
     */
    protected $gender;

    /**
     * @ORM\Column(type="date")
     * @Assert\DateTime()
     */
    protected $birthDate;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern="/\d{10}/",
     *     message="Télefono no válido, ingresa sólo números"
     * )
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Image(
     *     mimeTypes={ "image/jpeg", "image/png" },
     *     minWidth = 320,
     *     minWidthMessage = "La imagen es muy pequeña",
     *     minHeight = 320,
     *     minHeightMessage = "La imagen es muy pequeña",
     *     detectCorrupted = true,
     *     corruptedMessage = "La imagen esta corrupta",
     *     sizeNotDetectedMessage = "No se pudo detectar el tamaño",
     *     mimeTypesMessage = "La fotografía debe ser jpg o png"
     * )
     */
    protected $photo;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update", field={
           "username",
           "firstName",
           "lastName",
           "email",
           "address",
           "phoneNumber",
           "photo"
       })
     * @ORM\Column(type="datetime")
     */
    protected $modifiedAt;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // give everyone ROLE_USER!
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPasword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // Save the user even if only plainPassword changes
        $this->password = null;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }


    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
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
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @Gedmo\Timestampable(on="create")
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @Gedmo\Timestampable(on="update", field={"firstName",
     *     "lastName", "username", "email", "address", "phoneNumber", })
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt(\DateTime $modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }
}
