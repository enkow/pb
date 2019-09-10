<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostMarkRepository")
 * @ORM\Table(name="post_marks")
 */
class PostMark
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
     * @ORM\Column(type="integer")
     */
    private $mark;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortalPost", inversedBy="post_marks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal_post;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortalUser", inversedBy="post_marks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getPortalPost(): ?PortalPost
    {
        return $this->portal_post;
    }

    public function setPortalPost(?PortalPost $portal_post): self
    {
        $this->portal_post = $portal_post;

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
