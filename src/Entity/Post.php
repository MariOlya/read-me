<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $authorId = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $authorQuote = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'posts')]
    private ?self $originPost = null;

    #[ORM\OneToMany(mappedBy: 'originPost', targetEntity: self::class)]
    private Collection $posts;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PostType $typeId = null;

    #[ORM\Column]
    private ?int $viewAmount = null;

    #[ORM\Column]
    private ?bool $repost = null;

    #[ORM\OneToMany(mappedBy: 'postId', targetEntity: PostLink::class, orphanRemoval: true)]
    private Collection $postLinks;

    #[ORM\OneToMany(mappedBy: 'postId', targetEntity: PostVideoLink::class, orphanRemoval: true)]
    private Collection $postVideoLinks;

    #[ORM\OneToMany(mappedBy: 'postId', targetEntity: PostImage::class, orphanRemoval: true)]
    private Collection $postImages;

    #[ORM\OneToMany(mappedBy: 'postId', targetEntity: PostToHashtag::class, orphanRemoval: true)]
    private Collection $postToHashtags;


    #[ORM\ManyToMany(inversedBy: 'posts', targetEntity: Hashtag::class)]
    private $hashtags;

    #[ORM\OneToMany(mappedBy: 'postId', targetEntity: Like::class, orphanRemoval: true)]
    private Collection $likes;

    #[ORM\OneToMany(mappedBy: 'postId', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->postLinks = new ArrayCollection();
        $this->postVideoLinks = new ArrayCollection();
        $this->postImages = new ArrayCollection();
        $this->postToHashtags = new ArrayCollection();
        $this->hashtags = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getAuthorQuote(): ?string
    {
        return $this->authorQuote;
    }

    public function setAuthorQuote(?string $authorQuote): self
    {
        $this->authorQuote = $authorQuote;

        return $this;
    }

    public function getOriginPost(): ?self
    {
        return $this->originPost;
    }

    public function setOriginPost(?self $originPost): self
    {
        $this->originPost = $originPost;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(self $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setOriginPost($this);
        }

        return $this;
    }

    public function removePost(self $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getOriginPost() === $this) {
                $post->setOriginPost(null);
            }
        }

        return $this;
    }

    public function getTypeId(): ?PostType
    {
        return $this->typeId;
    }

    public function setTypeId(?PostType $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getViewAmount(): ?int
    {
        return $this->viewAmount;
    }

    public function setViewAmount(int $viewAmount): self
    {
        $this->viewAmount = $viewAmount;

        return $this;
    }

    public function isRepost(): ?bool
    {
        return $this->repost;
    }

    public function setRepost(bool $repost): self
    {
        $this->repost = $repost;

        return $this;
    }

    /**
     * @return Collection<int, PostLink>
     */
    public function getPostLinks(): Collection
    {
        return $this->postLinks;
    }

    public function addPostLink(PostLink $postLink): self
    {
        if (!$this->postLinks->contains($postLink)) {
            $this->postLinks->add($postLink);
            $postLink->setPostId($this);
        }

        return $this;
    }

    public function removePostLink(PostLink $postLink): self
    {
        if ($this->postLinks->removeElement($postLink)) {
            // set the owning side to null (unless already changed)
            if ($postLink->getPostId() === $this) {
                $postLink->setPostId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostVideoLink>
     */
    public function getPostVideoLinks(): Collection
    {
        return $this->postVideoLinks;
    }

    public function addPostVideoLink(PostVideoLink $postVideoLink): self
    {
        if (!$this->postVideoLinks->contains($postVideoLink)) {
            $this->postVideoLinks->add($postVideoLink);
            $postVideoLink->setPostId($this);
        }

        return $this;
    }

    public function removePostVideoLink(PostVideoLink $postVideoLink): self
    {
        if ($this->postVideoLinks->removeElement($postVideoLink)) {
            // set the owning side to null (unless already changed)
            if ($postVideoLink->getPostId() === $this) {
                $postVideoLink->setPostId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostImage>
     */
    public function getPostImages(): Collection
    {
        return $this->postImages;
    }

    public function addPostImage(PostImage $postImage): self
    {
        if (!$this->postImages->contains($postImage)) {
            $this->postImages->add($postImage);
            $postImage->setPostId($this);
        }

        return $this;
    }

    public function removePostImage(PostImage $postImage): self
    {
        if ($this->postImages->removeElement($postImage)) {
            // set the owning side to null (unless already changed)
            if ($postImage->getPostId() === $this) {
                $postImage->setPostId(null);
            }
        }

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
            $postToHashtag->setPostId($this);
        }

        return $this;
    }

    public function removePostToHashtag(PostToHashtag $postToHashtag): self
    {
        if ($this->postToHashtags->removeElement($postToHashtag)) {
            // set the owning side to null (unless already changed)
            if ($postToHashtag->getPostId() === $this) {
                $postToHashtag->setPostId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hashtag>
     */
    public function getHashtags(): Collection
    {
        return $this->hashtags;
    }

    public function addHashtag(Hashtag $hashtag): self
    {
        if (!$this->hashtags->contains($hashtag)) {
            $this->hashtags->add($hashtag);
            $hashtag->addPost($this);
        }
        return $this;
    }
    public function removeHashtag(Hashtag $hashtag): self
    {
        if ($this->hashtags->removeElement($hashtag)) {
            $hashtag->removePost($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setPostId($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getPostId() === $this) {
                $like->setPostId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPostId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPostId() === $this) {
                $comment->setPostId(null);
            }
        }

        return $this;
    }
}
