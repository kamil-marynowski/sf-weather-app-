<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $inter = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datetime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInter(): ?int
    {
        return $this->inter;
    }

    public function setInter(int $inter): self
    {
        $this->inter = $inter;

        return $this;
    }

    public function getDatetime(): ?\DateTimeImmutable
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeImmutable $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
}
