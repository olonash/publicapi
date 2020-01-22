<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     formats={"json"},
 *     itemOperations={},
 *     attributes={
 *        "filters"={"translation.groups"},
 *        "normalization_context"={"groups"={"locality_read"}},
 *        "denormalization_context"={"groups"={"locality_write"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\LocalityRepository")
 */
class Locality extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="type_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $typeCode;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $code;


    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $iso2Code;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $iso3Code;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=8, nullable=true)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=8, nullable=true)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $latitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locality")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id",nullable=true)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $parent;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CountryPhoneCode", mappedBy="country", cascade={"persist", "remove"})
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $countryPhoneCode;
    
    /**
     * @Groups({"locality_read"})
     */
    private $name;
    
    /**
     * @Groups({"locality_write", "translations"})
     * @ORM\OneToMany(targetEntity="App\Entity\LocalityTranslation", mappedBy="locality", cascade={"persist", "remove"})
     */
    protected $translations;

    public function setName($name)
    {
        $this->getTranslation()->setName($name);
    }

    public function getName(): string
    {
        return $this->getTranslation()->getName();
    }
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeCode(): ?MasterParameterValue
    {
        return $this->typeCode;
    }

    public function setTypeCode(?MasterParameterValue $typeCode): self
    {
        $this->typeCode = $typeCode;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

   
    public function getIso2Code(): ?string
    {
        return $this->iso2Code;
    }

    public function setIso2Code(string $iso2Code): self
    {
        $this->iso2Code = $iso2Code;

        return $this;
    }

    public function getIso3Code(): ?string
    {
        return $this->iso3Code;
    }

    public function setIso3Code(?string $iso3Code): self
    {
        $this->iso3Code = $iso3Code;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCountryPhoneCode(): ?CountryPhoneCode
    {
        return $this->countryPhoneCode;
    }

    public function setCountryPhoneCode(CountryPhoneCode $countryPhoneCode): self
    {
        $this->countryPhoneCode = $countryPhoneCode;

        // set the owning side of the relation if necessary
        if ($countryPhoneCode->getCountry() !== $this) {
            $countryPhoneCode->setCountry($this);
        }

        return $this;
    }
    
    protected function createTranslation():TranslationInterface
    {
        return new LocalityTranslation();
    }

    /**
     * @return Collection|LocalityTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }
    public function addTranslation(TranslationInterface $translation): void
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setLocality($this);
        }
    }

    public function removeTranslation(TranslationInterface $translation): void
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getLocality() === $this) {
                $translation->setLocality(null);
            }
        }
    }

}
