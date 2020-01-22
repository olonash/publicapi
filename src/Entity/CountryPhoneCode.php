<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations ={},
 *     itemOperations ={}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\CountryPhoneCodeRepository")
 */
class CountryPhoneCode
{
     /**
     * @ORM\OneToOne(targetEntity="App\Entity\Locality", inversedBy="countryPhoneCode", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false,name="country_id",referencedColumnName="id"))
     */
    private $country;
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $callingCode;


    public function getCountry(): ?Locality
    {
        return $this->country;
    }

    public function setCountry(Locality $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCallingCode(): ?int
    {
        return $this->callingCode;
    }

    public function setCallingCode(int $callingCode): self
    {
        $this->callingCode = $callingCode;

        return $this;
    }
}
