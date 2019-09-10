<?php
/**
 * PortalUser entity.
 */

namespace App\Entity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 *  * Class PortalUser.
 *
 * @property ArrayCollection portal_friends
 * @ORM\Entity(repositoryClass="App\Repository\PortalUserRepository")
 * @ORM\Table(name="portal_users")
 */
class PortalUser
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
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PortalPost", mappedBy="portal_user")
     */
    private $portal_posts;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PortalComment", mappedBy="portal_user")
     */
    private $portal_comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PortalPhoto", mappedBy="portal_user")
     */
    private $portal_photos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostMark", mappedBy="portal_user")
     */
    private $post_marks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PortalFriend", mappedBy="portal_user_1")
     */
    private $portalFriends;

    public function __construct(\DateTime $createdAt, \DateTime $updatedAt)
    {
        $this->portal_posts = new ArrayCollection();
        $this->portal_friends = new ArrayCollection();
        $this->portal_comments = new ArrayCollection();
        $this->portal_photos = new ArrayCollection();
        $this->post_marks = new ArrayCollection();
        $this->portalFriends = new ArrayCollection();
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Getter for Created at.
     *
     * @return \DateTimeInterface|null Created at
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Setter for Created at.
     *
     * @param \DateTimeInterface $createdAt Created at
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Getter for Updated at.
     *
     * @return \DateTimeInterface|null Updated at
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Setter for Updated at.
     *
     * @param \DateTimeInterface $updatedAt Updated at
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|PortalPost[]
     */
    public function getPortalPosts(): Collection
    {
        return $this->portal_posts;
    }

    public function addPortalPost(PortalPost $portalPost): self
    {
        if (!$this->portal_posts->contains($portalPost)) {
            $this->portal_posts[] = $portalPost;
            $portalPost->setPortalUser($this);
        }

        return $this;
    }

    public function removePortalPost(PortalPost $portalPost): self
    {
        if ($this->portal_posts->contains($portalPost)) {
            $this->portal_posts->removeElement($portalPost);
            // set the owning side to null (unless already changed)
            if ($portalPost->getPortalUser() === $this) {
                $portalPost->setPortalUser(null);
            }
        }

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
            $portalComment->setPortalUser($this);
        }

        return $this;
    }

    public function removePortalComment(PortalComment $portalComment): self
    {
        if ($this->portal_comments->contains($portalComment)) {
            $this->portal_comments->removeElement($portalComment);
            // set the owning side to null (unless already changed)
            if ($portalComment->getPortalUser() === $this) {
                $portalComment->setPortalUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PortalPhoto[]
     */
    public function getPortalPhotos(): Collection
    {
        return $this->portal_photos;
    }

    public function addPortalPhoto(PortalPhoto $portalPhoto): self
    {
        if (!$this->portal_photos->contains($portalPhoto)) {
            $this->portal_photos[] = $portalPhoto;
            $portalPhoto->setPortalUser($this);
        }

        return $this;
    }

    public function removePortalPhoto(PortalPhoto $portalPhoto): self
    {
        if ($this->portal_photos->contains($portalPhoto)) {
            $this->portal_photos->removeElement($portalPhoto);
            // set the owning side to null (unless already changed)
            if ($portalPhoto->getPortalUser() === $this) {
                $portalPhoto->setPortalUser(null);
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
            $postMark->setPortalUser($this);
        }

        return $this;
    }

    public function removePostMark(PostMark $postMark): self
    {
        if ($this->post_marks->contains($postMark)) {
            $this->post_marks->removeElement($postMark);
            // set the owning side to null (unless already changed)
            if ($postMark->getPortalUser() === $this) {
                $postMark->setPortalUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PortalFriend[]
     */
    public function getPortalFriends(): Collection
    {
        return $this->portalFriends;
    }

    public function addPortalFriend(PortalFriend $portalFriend): self
    {
        if (!$this->portalFriends->contains($portalFriend)) {
            $this->portalFriends[] = $portalFriend;
            $portalFriend->setPortalUser1($this);
        }

        return $this;
    }

    public function removePortalFriend(PortalFriend $portalFriend): self
    {
        if ($this->portalFriends->contains($portalFriend)) {
            $this->portalFriends->removeElement($portalFriend);
            // set the owning side to null (unless already changed)
            if ($portalFriend->getPortalUser1() === $this) {
                $portalFriend->setPortalUser1(null);
            }
        }

        return $this;
    }
}
