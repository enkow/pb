<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortalPostRepository")
 * @ORM\Table(name="portal_posts")
 */
class PortalPost
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
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortalUser", inversedBy="portal_posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal_user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PortalComment", mappedBy="portal_post")
     */
    private $portal_comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostMark", mappedBy="portal_post")
     */
    private $post_marks;

    public function __construct()
    {
        $this->portal_comments = new ArrayCollection();
        $this->post_marks = new ArrayCollection();
    }

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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

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

    /**
     * @return Collection|PortalComment[]
     */
    public function getPortalComments(): Collection
    {
        return $this->portal_comments;
    }

    public function addPortalComment(PortalComment $portalComment): self
    {
        if (!$this->portal_comments->contains($portalComment)) {
            $this->portal_comments[] = $portalComment;
            $portalComment->setPortalPost($this);
        }

        return $this;
    }

    public function removePortalComment(PortalComment $portalComment): self
    {
        if ($this->portal_comments->contains($portalComment)) {
            $this->portal_comments->removeElement($portalComment);
            // set the owning side to null (unless already changed)
            if ($portalComment->getPortalPost() === $this) {
                $portalComment->setPortalPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PostMark[]
     */
    public function getPostMarks(): Collection
    {
        return $this->post_marks;
    }

    public function addPostMark(PostMark $postMark): self
    {
        if (!$this->post_marks->contains($postMark)) {
            $this->post_marks[] = $postMark;
            $postMark->setPortalPost($this);
        }

        return $this;
    }

    public function removePostMark(PostMark $postMark): self
    {
        if ($this->post_marks->contains($postMark)) {
            $this->post_marks->removeElement($postMark);
            // set the owning side to null (unless already changed)
            if ($postMark->getPortalPost() === $this) {
                $postMark->setPortalPost(null);
            }
        }

        return $this;
    }
}
