<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(formats={"json"},
 *     collectionOperations ={"GET"},
 *     itemOperations ={"GET"})
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
{
    /**
     * @ORM\ID
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @Groups({"read"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read"})
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private $master;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private $active;

    /**
     * @var MasterParameterValues[]|null
     * @ORM\OneToMany(targetEntity="App\Entity\MasterParameterValue", cascade={"persist", "remove"}, mappedBy="parameter")
     */
    private $masterParameterValues;

    public function __construct()
    {
        $this->masterParameterValues = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
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

    public function getMaster(): ?bool
    {
        return $this->master;
    }

    public function setMaster(bool $master): self
    {
        $this->master = $master;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|MasterParameterValue[]
     */
    public function getMasterParameterValues(): Collection
    {
        return $this->masterParameterValues;
    }

    public function addMasterParameterValue(MasterParameterValue $masterParameterValue): self
    {
        if (!$this->masterParameterValues->contains($masterParameterValue)) {
            $this->masterParameterValues[] = $masterParameterValue;
            $masterParameterValue->setParameter($this);
        }

        return $this;
    }

    public function removeMasterParameterValue(MasterParameterValue $masterParameterValue): self
    {
        if ($this->masterParameterValues->contains($masterParameterValue)) {
            $this->masterParameterValues->removeElement($masterParameterValue);
            // set the owning side to null (unless already changed)
            if ($masterParameterValue->getParameter() === $this) {
                $masterParameterValue->setParameter(null);
            }
        }

        return $this;
    }
}
