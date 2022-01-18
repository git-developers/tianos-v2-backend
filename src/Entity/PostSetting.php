<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostSetting
 *
 * @ORM\Table(name="post_setting", indexes={@ORM\Index(name="fk_post_setting_post1_idx", columns={"post_id"})})
 * @ORM\Entity
 */
class PostSetting
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
     * @var bool|null
     *
     * @ORM\Column(name="allow_comments", type="boolean", nullable=true)
     */
    private $allowComments = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="allow_duet", type="boolean", nullable=true)
     */
    private $allowDuet = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="save_to_device", type="boolean", nullable=true)
     */
    private $saveToDevice = '0';

    /**
     * @var \Post
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAllowComments(): ?bool
    {
        return $this->allowComments;
    }

    public function setAllowComments(?bool $allowComments): self
    {
        $this->allowComments = $allowComments;

        return $this;
    }

    public function getAllowDuet(): ?bool
    {
        return $this->allowDuet;
    }

    public function setAllowDuet(?bool $allowDuet): self
    {
        $this->allowDuet = $allowDuet;

        return $this;
    }

    public function getSaveToDevice(): ?bool
    {
        return $this->saveToDevice;
    }

    public function setSaveToDevice(?bool $saveToDevice): self
    {
        $this->saveToDevice = $saveToDevice;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }


}
