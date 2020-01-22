<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={},
 *     itemOperations={}
 *     )
 * @ApiFilter(SearchFilter::class, properties={"object":"exact","objectId":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ObjectAddressRepository")
 */
class ObjectAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessObject")
     * @ORM\JoinColumn(name="object_code", referencedColumnName="object_code",nullable=false)
     */
    private $object;

    /**
     * @ORM\Column(type="integer")
     */
    private $objectId;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cityName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $zipCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locality")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     */
    private $billing;

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     */
    private $shipping;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id", nullable=true)
     */
    private $tenant;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObject(): ?BusinessObject
    {
        return $this->object;
    }

    public function setObject(?BusinessObject $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    public function setObjectId(int $objectId): self
    {
        $this->objectId = $objectId;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(?string $cityName): self
    {
        $this->cityName = $cityName;

        return $this;
    }

    public function getCountry(): ?Locality
    {
        return $this->country;
    }

    public function setCountry(?Locality $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBilling(): ?bool
    {
        return $this->billing;
    }

    public function setBilling(bool $billing): self
    {
        $this->billing = $billing;

        return $this;
    }

    public function getShipping(): ?bool
    {
        return $this->shipping;
    }

    public function setShipping(bool $shipping): self
    {
        $this->shipping = $shipping;

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

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function setTenant(?Tenant $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }
}
