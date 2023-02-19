<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $fileSrc = null;

    #[ORM\ManyToOne(inversedBy: 'files')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FileType $typeId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileSrc(): ?string
    {
        return $this->fileSrc;
    }

    public function setFileSrc(string $fileSrc): self
    {
        $this->fileSrc = $fileSrc;

        return $this;
    }

    public function getTypeId(): ?FileType
    {
        return $this->typeId;
    }

    public function setTypeId(?FileType $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }
}
