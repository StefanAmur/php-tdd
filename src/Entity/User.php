<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $username;

    #[ORM\Column(type: 'integer', options: ['default' => 100])]
    private $credit;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private $premiumMember;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Bookings::class)]
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getPremiumMember(): ?bool
    {
        return $this->premiumMember;
    }

    public function setPremiumMember(bool $premiumMember): self
    {
        $this->premiumMember = $premiumMember;

        return $this;
    }

    /**
     * @return Collection|Bookings[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Bookings $booking): self
    {
        if (!$this->bookings->contains($booking))
        {
            $this->bookings[] = $booking;
            $booking->setUser($this);
        }

        return $this;
    }

    public function removeBooking(Bookings $booking): self
    {
        if ($this->bookings->removeElement($booking))
        {
            // set the owning side to null (unless already changed)
            if ($booking->getUser() === $this)
            {
                $booking->setUser(null);
            }
        }

        return $this;
    }
}
