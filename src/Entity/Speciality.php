<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'speciality', targetEntity: img::class)]
    private $speciality;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    public function __construct()
    {
        $this->speciality = new ArrayCollection();
        $this->Speciality = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, img>
     */
    public function getSpeciality(): Collection
    {
        return $this->speciality;
    }

    public function addSpeciality(img $speciality): self
    {
        if (!$this->speciality->contains($speciality)) {
            $this->speciality[] = $speciality;
            $speciality->setSpeciality($this);
        }

        return $this;
    }

    public function removeSpeciality(img $speciality): self
    {
        if ($this->speciality->removeElement($speciality)) {
            // set the owning side to null (unless already changed)
            if ($speciality->getSpeciality() === $this) {
                $speciality->setSpeciality(null);
            }
        }

        return $this;
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
}
