<?php

namespace App\Entity;

use App\Repository\HashtagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HashtagRepository::class)]
class Hashtag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $tag = null;

    #[ORM\OneToMany(mappedBy: 'hashtagId', targetEntity: PostToHashtag::class, orphanRemoval: true)]
    private Collection $postToHashtags;

    #[ORM\ManyToMany(mappedBy: 'hashtags', targetEntity: Post::class)]
    private $posts;

    public function __construct()
    {
        $this->postToHashtags = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, PostToHashtag>
     */
    public function getPostToHashtags(): Collection
    {
        return $this->postToHashtags;
    }

    public function addPostToHashtag(PostToHashtag $postToHashtag): self
    {
        if (!$this->postToHashtags->contains($postToHashtag)) {
            $this->postToHashtags->add($postToHashtag);
            $postToHashtag->setHashtagId($this);
        }

        return $this;
    }

    public function removePostToHashtag(PostToHashtag $postToHashtag): self
    {
        if ($this->postToHashtags->removeElement($postToHashtag)) {
            // set the owning side to null (unless already changed)
            if ($postToHashtag->getHashtagId() === $this) {
                $postToHashtag->setHashtagId(null);
            }
        }

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
            $post->addHashtag($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            $post->removeHashtag($this);
        }

        return $this;
    }
}
