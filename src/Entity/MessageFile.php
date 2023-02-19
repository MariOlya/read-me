<?php

namespace App\Entity;

use App\Repository\MessageFileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageFileRepository::class)]
class MessageFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?File $fileId = null;

    #[ORM\ManyToOne(inversedBy: 'messageFiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Message $messageId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileId(): ?File
    {
        return $this->fileId;
    }

    public function setFileId(File $fileId): self
    {
        $this->fileId = $fileId;

        return $this;
    }

    public function getMessageId(): ?Message
    {
        return $this->messageId;
    }

    public function setMessageId(?Message $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }
}
