<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'chatsFromFirstPosition')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $firstUserId = null;

    #[ORM\ManyToOne(inversedBy: 'chatsFromSecondPosition')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $secondUserId = null;

    #[ORM\OneToMany(mappedBy: 'chatId', targetEntity: Message::class, orphanRemoval: true)]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstUserId(): ?User
    {
        return $this->firstUserId;
    }

    public function setFirstUserId(?User $firstUserId): self
    {
        $this->firstUserId = $firstUserId;

        return $this;
    }

    public function getSecondUserId(): ?User
    {
        return $this->secondUserId;
    }

    public function setSecondUserId(?User $secondUserId): self
    {
        $this->secondUserId = $secondUserId;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setChatId($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getChatId() === $this) {
                $message->setChatId(null);
            }
        }

        return $this;
    }
}
