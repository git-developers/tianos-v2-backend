<?php

namespace App\Entity;

use App\Repository\Gato3Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Gato3Repository::class)
 */
class Gato3
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aaaaa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bbbbbb;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAaaaa(): ?string
    {
        return $this->aaaaa;
    }

    public function setAaaaa(string $aaaaa): self
    {
        $this->aaaaa = $aaaaa;

        return $this;
    }

    public function getBbbbbb(): ?string
    {
        return $this->bbbbbb;
    }

    public function setBbbbbb(string $bbbbbb): self
    {
        $this->bbbbbb = $bbbbbb;

        return $this;
    }
}
