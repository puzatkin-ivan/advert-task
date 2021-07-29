<?php

namespace App\Entity;

use App\Repository\AdvertRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdvertRepository::class)
 */
class Advert
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
    private $text;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $show_count;

    /**
     * @ORM\Column(type="integer")
     */
    private $show_limit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $banner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShowLimit(): int
    {
        return $this->show_limit;
    }

    public function setShowLimit(int $show_limit): self
    {
        $this->show_limit = $show_limit;

        return $this;
    }

    public function getShowCount(): int
    {
        return $this->show_count;
    }

    public function setShowCount(int $show_count): self
    {
        $this->show_count = $show_count;

        return $this;
    }

    public function getBanner(): string
    {
        return $this->banner;
    }

    public function setBanner(string $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    public function incrementShowCount(): void
    {
        $this->show_count++;
    }
}
