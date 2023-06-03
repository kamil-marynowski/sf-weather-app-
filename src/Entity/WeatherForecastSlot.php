<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\WeatherForecastSlotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherForecastSlotRepository::class)]
class WeatherForecastSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $type_id = null;

    #[ORM\Column]
    private ?\DateTime $datetime = null;

    #[ORM\Column(length: 255)]
    private ?string $icon_class = null;

    #[ORM\Column]
    private ?float $temperature = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeId(): ?int
    {
        return $this->type_id;
    }

    public function setTypeId(int $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTime $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getIconClass(): ?string
    {
        return $this->icon_class;
    }

    public function setIconClass(string $icon_class): self
    {
        $this->icon_class = $icon_class;

        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }
}
