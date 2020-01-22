<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  formats={"json"},
 *     collectionOperations ={"GET","POST"},
 *     itemOperations ={"GET"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BusinessObjectRepository")
 */
class BusinessObject
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @Groups({"read"})
     */
    private $objectCode;
   
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private $active;

    public function getObjectCode(): ?string
    {
        return $this->objectCode;
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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
