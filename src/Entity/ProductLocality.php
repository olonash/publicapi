<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={},
 *     itemOperations={}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductLocalityRepository")
 */
class ProductLocality
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="localities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locality")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product_read", "product_write", "translations"}) 
     */
    private $locality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="role_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"product_read", "product_write", "translations"}) 
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getLocality(): ?Locality
    {
        return $this->locality;
    }

    public function setLocality(?Locality $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getRole(): ?MasterParameterValue
    {
        return $this->role;
    }

    public function setRole(?MasterParameterValue $role): self
    {
        $this->role = $role;

        return $this;
    }
}
