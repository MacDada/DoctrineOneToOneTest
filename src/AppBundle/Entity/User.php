<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @var UserProfile|null
     *
     * @ORM\OneToOne(targetEntity="UserProfile", mappedBy="user", cascade="persist")
     */
    private $profile = null;

    public function __construct($username)
    {
        $this->username = $username;

        // $this->profile = new UserProfile($this);
    }

    public function createProfile()
    {
        $this->profile = new UserProfile($this);
    }

    /**
     * @return int
     * @throws \DomainException
     */
    public function getId()
    {
        if (null === $this->id) {
            throw new \DomainException("User doesn't have an id yet");
        }

        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return UserProfile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
