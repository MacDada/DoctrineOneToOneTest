<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="profiles")
 */
class UserProfile
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", mappedBy="id", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->username = $user->getUsername();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->user->getId();
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
