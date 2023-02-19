<?php

namespace App\Entity;

use App\Repository\SubscribeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscribeRepository::class)]
class Subscribe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'subscribers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $authorId = null;

    #[ORM\ManyToOne(inversedBy: 'subscribes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $subscriberId = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubscriberId(): ?User
    {
        return $this->subscriberId;
    }

    public function setSubscriberId(?User $subscriberId): self
    {
        $this->subscriberId = $subscriberId;

        return $this;
    }
}
