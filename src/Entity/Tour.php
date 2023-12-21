<?php

namespace App\Entity;

use App\Repository\TourRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TourRepository::class)]
class Tour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 30)]
    private ?string $location = null;

    #[ORM\Column(nullable: true)]
    private ?int $day = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?bool $online = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'tour', targetEntity: Gallery::class)]
    private Collection $galleries;

    #[ORM\OneToMany(mappedBy: 'tour', targetEntity: TourRequest::class)]
    private Collection $tourRequests;

    #[ORM\OneToMany(mappedBy: 'tour', targetEntity: DayInfo::class)]
    private Collection $dayInfos;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->galleries = new ArrayCollection();
        $this->tourRequests = new ArrayCollection();
        $this->dayInfos = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(?bool $online): static
    {
        $this->online = $online;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Gallery>
     */
    public function getGalleries(): Collection
    {
        return $this->galleries;
    }

    public function addGallery(Gallery $gallery): static
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries->add($gallery);
            $gallery->setTour($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): static
    {
        if ($this->galleries->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getTour() === $this) {
                $gallery->setTour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TourRequest>
     */
    public function getTourRequests(): Collection
    {
        return $this->tourRequests;
    }

    public function addTourRequest(TourRequest $tourRequest): static
    {
        if (!$this->tourRequests->contains($tourRequest)) {
            $this->tourRequests->add($tourRequest);
            $tourRequest->setTour($this);
        }

        return $this;
    }

    public function removeTourRequest(TourRequest $tourRequest): static
    {
        if ($this->tourRequests->removeElement($tourRequest)) {
            // set the owning side to null (unless already changed)
            if ($tourRequest->getTour() === $this) {
                $tourRequest->setTour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DayInfo>
     */
    public function getDayInfos(): Collection
    {
        return $this->dayInfos;
    }

    public function addDayInfo(DayInfo $dayInfo): static
    {
        if (!$this->dayInfos->contains($dayInfo)) {
            $this->dayInfos->add($dayInfo);
            $dayInfo->setTour($this);
        }

        return $this;
    }

    public function removeDayInfo(DayInfo $dayInfo): static
    {
        if ($this->dayInfos->removeElement($dayInfo)) {
            // set the owning side to null (unless already changed)
            if ($dayInfo->getTour() === $this) {
                $dayInfo->setTour(null);
            }
        }

        return $this;
    }
}
