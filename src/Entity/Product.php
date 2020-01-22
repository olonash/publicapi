<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     formats={"json"},
 *     itemOperations={},
 *     attributes={
 *        "filters"={"translation.groups"},
 *        "normalization_context"={"groups"={"product_read"}},
 *        "denormalization_context"={"groups"={"product_write"}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"tenant":"exact","id":"exact","translations.name":"partial"})
 * @ApiFilter(BooleanFilter::class, properties={"active"})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product  extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product_read", "translations"})
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id",nullable=false)
     * @Groups({"product_read", "product_write", "translations"}) 
     */
    private $tenant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="type_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="sub_type_code", referencedColumnName="value_code")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $subType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="inventory_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $inventoryType;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $externalReference;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="external_system_code", referencedColumnName="value_code")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $externalSystem;

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $durationDays;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $durationNights;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $durationHours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $durationMinutes;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ThirdParty", inversedBy="products")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id",nullable=false)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $supplier;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $producerReference;
    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue")
     * @ORM\JoinColumn(name="sub_group_id", referencedColumnName="id")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $subGroup;


    /**
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductTranslation", mappedBy="product", cascade={"persist", "remove"})
     * @Groups({"product_read","product_write", "translations"})
     */
    protected $translations;
    

    /**
     * @Groups({"product_read", "product_write", "translations"})
     * @ORM\Column(type="decimal", precision=4, scale=2,options={"default" : 0})
     */
    private $vatPercentage;
    
     /**
     * @ORM\Column(type="decimal", precision=19, scale=8, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=8, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $departureTime;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $arrivalTime;

    /**
     * @ORM\Column(type="integer",length=1,options={"default" : 0})
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $arrivalDayPlus;

    /**
     * @ORM\Column(type="integer", length=1, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $stars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductLocality", mappedBy="product", cascade={"persist", "remove"})
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $localities;

    public function __construct()
    {
        parent::__construct();
        $this->localities = new ArrayCollection();
    }

  
    
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

    public function getType(): ?MasterParameterValue
    {
        return $this->type;
    }

    public function setType(?MasterParameterValue $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSubType(): ?MasterParameterValue
    {
        return $this->subType;
    }

    public function setSubType(?MasterParameterValue $subType): self
    {
        $this->subType = $subType;

        return $this;
    }

    public function getInventoryType(): ?MasterParameterValue
    {
        return $this->inventoryType;
    }

    public function setInventoryType(?MasterParameterValue $inventoryType): self
    {
        $this->inventoryType = $inventoryType;

        return $this;
    }

    public function getExternalReference(): ?string
    {
        return $this->externalReference;
    }

    public function setExternalReference(?string $externalReference): self
    {
        $this->externalReference = $externalReference;

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

    public function getDurationDays(): ?int
    {
        return $this->durationDays;
    }

    public function setDurationDays(?int $durationDays): self
    {
        $this->durationDays = $durationDays;

        return $this;
    }

    public function getDurationNights(): ?int
    {
        return $this->durationNights;
    }

    public function setDurationNights(?int $durationNights): self
    {
        $this->durationNights = $durationNights;

        return $this;
    }

    public function getDurationHours(): ?int
    {
        return $this->durationHours;
    }

    public function setDurationHours(?int $durationHours): self
    {
        $this->durationHours = $durationHours;

        return $this;
    }

    public function getDurationMinutes(): ?int
    {
        return $this->durationMinutes;
    }

    public function setDurationMinutes(?int $durationMinutes): self
    {
        $this->durationMinutes = $durationMinutes;

        return $this;
    }

    public function getSupplier(): ?ThirdParty
    {
        return $this->supplier;
    }

    public function setSupplier(?ThirdParty $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getGroup(): ?TenantParameterValue
    {
        return $this->group;
    }

    public function setGroup(?TenantParameterValue $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getSubGroup(): ?TenantParameterValue
    {
        return $this->subGroup;
    }

    public function setSubGroup(?TenantParameterValue $subGroup): self
    {
        $this->subGroup = $subGroup;

        return $this;
    }

    protected function createTranslation():TranslationInterface
    {
        return new ProductTranslation();
    }

    /**
     * @return Collection|ProductTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }
    public function addTranslation(TranslationInterface $translation): void
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setProduct($this);
        }
    }

    public function removeTranslation(TranslationInterface $translation): void
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getProduct() === $this) {
                $translation->setProduct(null);
            }
        }
    }

    public function getExternalSystem(): ?MasterParameterValue
    {
        return $this->externalSystem;
    }

    public function setExternalSystem(?MasterParameterValue $externalSystem): self
    {
        $this->externalSystem = $externalSystem;

        return $this;
    }

    public function getVatPercentage(): ?string
    {
        return $this->vatPercentage;
    }

    public function setVatPercentage(?string $vatPercentage): self
    {
        $this->vatPercentage = $vatPercentage;

        return $this;
    }

    public function getProducerReference(): ?string
    {
        return $this->producerReference;
    }

    public function setProducerReference(?string $producerReference): self
    {
        $this->producerReference = $producerReference;

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

    public function getDepartureTime(): ?string
    {
        return $this->departureTime;
    }

    public function setDepartureTime(?string $departureTime): self
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    public function getArrivalTime(): ?string
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(?string $arrivalTime): self
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    public function getArrivalDayPlus(): ?int
    {
        return $this->arrivalDayPlus;
    }

    public function setArrivalDayPlus(?int $arrivalDayPlus): self
    {
        $this->arrivalDayPlus = $arrivalDayPlus;

        return $this;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(?int $stars): self
    {
        $this->stars = $stars;

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

    /**
     * @return Collection|ProductLocality[]
     */
    public function getLocalities(): Collection
    {
        return $this->localities;
    }

    public function addLocality(ProductLocality $locality): self
    {
        if (!$this->localities->contains($locality)) {
            $this->localities[] = $locality;
            $locality->setProduct($this);
        }

        return $this;
    }

    public function removeLocality(ProductLocality $locality): self
    {
        if ($this->localities->contains($locality)) {
            $this->localities->removeElement($locality);
            // set the owning side to null (unless already changed)
            if ($locality->getProduct() === $this) {
                $locality->setProduct(null);
            }
        }

        return $this;
    }

}
