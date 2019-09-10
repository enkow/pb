<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortalFriendRepository")
 *  @ORM\Table(name="portal_friends")
 */
class PortalFriend
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     *
     * @constant int NUMBER_OF_ITEMS
     */
    const NUMBER_OF_ITEMS = 10;
    /**
     * Primary key.
     *
     * @var int
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortalUser", inversedBy="portalFriends")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal_user_1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortalUser", inversedBy="portalFriends")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal_user_2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPortalUser1(): ?PortalUser
    {
        return $this->portal_user_1;
    }

    public function setPortalUser1(?PortalUser $portal_user_1): self
    {
        $this->portal_user_1 = $portal_user_1;

        return $this;
    }

    public function getPortalUser2(): ?PortalUser
    {
        return $this->portal_user_2;
    }

    public function setPortalUser2(?PortalUser $portal_user_2): self
    {
        $this->portal_user_2 = $portal_user_2;

        return $this;
    }
}
