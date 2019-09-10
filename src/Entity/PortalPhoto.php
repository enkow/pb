<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortalPhotoRepository")
 * @ORM\Table(name="portal_photos")
 */
class PortalPhoto
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
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortalUser", inversedBy="portal_photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPortalUser(): ?PortalUser
    {
        return $this->portal_user;
    }

    public function setPortalUser(?PortalUser $portal_user): self
    {
        $this->portal_user = $portal_user;

        return $this;
    }
}
