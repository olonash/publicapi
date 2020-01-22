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
 * )
 * @ApiFilter(SearchFilter::class, properties={"object":"exact","objectId":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ObjectPhoneRepository")
 */
class ObjectPhone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $number;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="type_code", referencedColumnName="value_code",nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CountryPhoneCode")
     * @ORM\JoinColumn(name="calling_code", referencedColumnName="calling_code")
     */
    private $calling_code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id", nullable=true)
     */
    private $tenant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
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

    public function setObjectId(int $ObjectId): self
    {
        $this->objectId = $objectId;

        return $this;
    }

    public function getType(): ?MasterParameterValue
    {
        return $this->type;
    }

    public function setType(?MasterParameterValue $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCallingCode(): ?CountryPhoneCode
    {
        return $this->calling_code;
    }

    public function setCallingCode(?CountryPhoneCode $calling_code): self
    {
        $this->calling_code = $calling_code;

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
