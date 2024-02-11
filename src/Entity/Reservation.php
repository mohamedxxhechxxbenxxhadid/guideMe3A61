<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'reservation')]
    private Collection $transports;

    #[ORM\OneToMany(targetEntity: Lodging::class, mappedBy: 'reservation')]
    private Collection $lodgings;

    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'reservation')]
    private Collection $events;

    public function __construct()
    {
        $this->transports = new ArrayCollection();
        $this->lodgings = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Transport>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): static
    {
        if (!$this->transports->contains($transport)) {
            $this->transports->add($transport);
            $transport->setReservation($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): static
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getReservation() === $this) {
                $transport->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lodging>
     */
    public function getLodgings(): Collection
    {
        return $this->lodgings;
    }

    public function addLodging(Lodging $lodging): static
    {
        if (!$this->lodgings->contains($lodging)) {
            $this->lodgings->add($lodging);
            $lodging->setReservation($this);
        }

        return $this;
    }

    public function removeLodging(Lodging $lodging): static
    {
        if ($this->lodgings->removeElement($lodging)) {
            // set the owning side to null (unless already changed)
            if ($lodging->getReservation() === $this) {
                $lodging->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setReservation($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getReservation() === $this) {
                $event->setReservation(null);
            }
        }

        return $this;
    }
}
