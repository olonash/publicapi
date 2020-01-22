<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *  formats={"json"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 */
class Phone
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
    private $objectCode;

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
     * @ORM\JoinColumn(name="calling_code", referencedColumnName="calling_code",nullable=false)
     */
    private $calling_code;

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

    public function getObjectCode(): ?BusinessObject
    {
        return $this->objectCode;
    }

    public function setObjectCode(?BusinessObject $objectCode): self
    {
        $this->objectCode = $objectCode;

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

    public function getCountry(): ?CountryPhoneCode
    {
        return $this->country;
    }

    public function setCountry(?CountryPhoneCode $country): self
    {
        $this->country = $country;

        return $this;
    }
}
