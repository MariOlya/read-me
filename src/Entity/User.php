<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity('email')]
class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $createAt = null;

    #[ORM\Column(length: 30)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?File $avatarId = null;

    #[ORM\OneToMany(mappedBy: 'authorId', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'authorId', targetEntity: Subscribe::class, orphanRemoval: true)]
    private Collection $subscribers;

    #[ORM\OneToMany(mappedBy: 'subscriberId', targetEntity: Subscribe::class, orphanRemoval: true)]
    private Collection $subscribes;

    #[ORM\OneToMany(mappedBy: 'firstUserId', targetEntity: Chat::class, orphanRemoval: true)]
    private Collection $chatsFromFirstPosition;

    #[ORM\OneToMany(mappedBy: 'secondUserId', targetEntity: Chat::class, orphanRemoval: true)]
    private Collection $chatsFromSecondPosition;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->subscribers = new ArrayCollection();
        $this->subscribes = new ArrayCollection();
        $this->chatsFromFirstPosition = new ArrayCollection();
        $this->chatsFromSecondPosition = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getAvatarId(): ?File
    {
        return $this->avatarId;
    }

    public function setAvatarId(?File $avatarId): self
    {
        $this->avatarId = $avatarId;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthorId($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthorId() === $this) {
                $post->setAuthorId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subscribe>
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    public function addSubscriber(Subscribe $subscriber): self
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers->add($subscriber);
            $subscriber->setAuthorId($this);
        }

        return $this;
    }

    public function removeSubscriber(Subscribe $subscriber): self
    {
        if ($this->subscribers->removeElement($subscriber)) {
            // set the owning side to null (unless already changed)
            if ($subscriber->getAuthorId() === $this) {
                $subscriber->setAuthorId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subscribe>
     */
    public function getSubscribes(): Collection
    {
        return $this->subscribes;
    }

    public function addSubscribe(Subscribe $subscribe): self
    {
        if (!$this->subscribes->contains($subscribe)) {
            $this->subscribes->add($subscribe);
            $subscribe->setSubscriberId($this);
        }

        return $this;
    }

    public function removeSubscribe(Subscribe $subscribe): self
    {
        if ($this->subscribes->removeElement($subscribe)) {
            // set the owning side to null (unless already changed)
            if ($subscribe->getSubscriberId() === $this) {
                $subscribe->setSubscriberId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chat>
     */
    public function getChats(): Collection
    {

        return new ArrayCollection(
            array_merge($this->chatsFromFirstPosition->toArray(), $this->chatsFromSecondPosition->toArray())
        );
    }

    public function addChatsFromFirstPosition(Chat $chatsFromFirstPosition): self
    {
        if (!$this->chatsFromFirstPosition->contains($chatsFromFirstPosition)) {
            $this->chatsFromFirstPosition->add($chatsFromFirstPosition);
            $chatsFromFirstPosition->setFirstUserId($this);
        }

        return $this;
    }

    public function removeChatsFromFirstPosition(Chat $chatsFromFirstPosition): self
    {
        if ($this->chatsFromFirstPosition->removeElement($chatsFromFirstPosition)) {
            // set the owning side to null (unless already changed)
            if ($chatsFromFirstPosition->getFirstUserId() === $this) {
                $chatsFromFirstPosition->setFirstUserId(null);
            }
        }

        return $this;
    }

    public function addChatsFromSecondPosition(Chat $chatsFromSecondPosition): self
    {
        if (!$this->chatsFromSecondPosition->contains($chatsFromSecondPosition)) {
            $this->chatsFromSecondPosition->add($chatsFromSecondPosition);
            $chatsFromSecondPosition->setSecondUserId($this);
        }

        return $this;
    }

    public function removeChatsFromSecondPosition(Chat $chatsFromSecondPosition): self
    {
        if ($this->chatsFromSecondPosition->removeElement($chatsFromSecondPosition)) {
            // set the owning side to null (unless already changed)
            if ($chatsFromSecondPosition->getSecondUserId() === $this) {
                $chatsFromSecondPosition->setSecondUserId(null);
            }
        }

        return $this;
    }
}
