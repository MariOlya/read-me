<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $authorId = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chat $chatId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\OneToMany(mappedBy: 'messageId', targetEntity: MessageFile::class, orphanRemoval: true)]
    private Collection $messageFiles;

    public function __construct()
    {
        $this->messageFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAuthorId(): ?User
    {
        return $this->authorId;
    }

    public function setAuthorId(?User $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function getChatId(): ?Chat
    {
        return $this->chatId;
    }

    public function setChatId(?Chat $chatId): self
    {
        $this->chatId = $chatId;

        return $this;
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

    /**
     * @return Collection<int, MessageFile>
     */
    public function getMessageFiles(): Collection
    {
        return $this->messageFiles;
    }

    public function addMessageFile(MessageFile $messageFile): self
    {
        if (!$this->messageFiles->contains($messageFile)) {
            $this->messageFiles->add($messageFile);
            $messageFile->setMessageId($this);
        }

        return $this;
    }

    public function removeMessageFile(MessageFile $messageFile): self
    {
        if ($this->messageFiles->removeElement($messageFile)) {
            // set the owning side to null (unless already changed)
            if ($messageFile->getMessageId() === $this) {
                $messageFile->setMessageId(null);
            }
        }

        return $this;
    }
}
