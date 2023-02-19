<?php

namespace App\Entity;

use App\Repository\PostToHashtagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostToHashtagRepository::class)]
class PostToHashtag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'postToHashtags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $postId = null;

    #[ORM\ManyToOne(inversedBy: 'postToHashtags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hashtag $hashtagId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?Post
    {
        return $this->postId;
    }

    public function setPostId(?Post $postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    public function getHashtagId(): ?Hashtag
    {
        return $this->hashtagId;
    }

    public function setHashtagId(?Hashtag $hashtagId): self
    {
        $this->hashtagId = $hashtagId;

        return $this;
    }
}
