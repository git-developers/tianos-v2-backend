<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiktokFeed
 *
 * @ORM\Table(name="tiktok_feed")
 * @ORM\Entity
 */
class TiktokFeed
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url_list", type="text", length=65535, nullable=true)
     */
    private $url_list;

    /**
     * @var string|null
     *
     * @ORM\Column(name="author_uid", type="text", length=65535, nullable=true)
     */
    private $author_uid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aweme_id", type="text", length=65535, nullable=true)
     */
    private $aweme_id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aweme_nickname", type="text", length=65535, nullable=true)
     */
    private $aweme_nickname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="author_signature", type="text", length=65535, nullable=true)
     */
    private $author_signature;











    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUrlList(): ?string
    {
        return $this->url_list;
    }

    public function setUrlList(?string $url_list): self
    {
        $this->url_list = $url_list;

        return $this;
    }

    public function getAuthorUid(): ?string
    {
        return $this->author_uid;
    }

    public function setAuthorUid(?string $author_uid): self
    {
        $this->author_uid = $author_uid;

        return $this;
    }

    public function getAwemeId(): ?string
    {
        return $this->aweme_id;
    }

    public function setAwemeId(?string $aweme_id): self
    {
        $this->aweme_id = $aweme_id;

        return $this;
    }

    public function getAwemeNickname(): ?string
    {
        return $this->aweme_nickname;
    }

    public function setAwemeNickname(?string $aweme_nickname): self
    {
        $this->aweme_nickname = $aweme_nickname;

        return $this;
    }

    public function getAuthorSignature(): ?string
    {
        return $this->author_signature;
    }

    public function setAuthorSignature(?string $author_signature): self
    {
        $this->author_signature = $author_signature;

        return $this;
    }



}
