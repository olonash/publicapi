<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 * formats={"json"},
 *     collectionOperations={
 *        "get" : {"method": "GET"},
 *        "post" : {
 *           "method": "POST",
 *           "normalization_context"={"groups"={"translations"}},
 *        }
 *     },
 *     itemOperations={
 *        "get" : {"method": "GET"},
 *        "put" : {
 *           "method": "PUT",
 *           "normalization_context"={"groups"={"translations"}},
 *        }
 *     },
 *     attributes={
 *        "filters"={"translation.groups"},
 *        "normalization_context"={"groups"={"product_read"}},
 *        "denormalization_context"={"groups"={"product_write"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product  extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"translations"})
     */
    private $id;

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
     * @ORM\Column(type="boolean")
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
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $childMinAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $childMaxAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $babyMinAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $babyMaxAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $callPriceBeforeDiscount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $callPrice;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, nullable=true)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $discountPourcentage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ThirdParty", inversedBy="products")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id",nullable=false)
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $supplier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ThirdParty")
     * @ORM\JoinColumn(name="operator_id", referencedColumnName="id")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $operator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterValue")
     * @ORM\JoinColumn(name="group_code", referencedColumnName="value_code")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $groupCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterValue")
     * @ORM\JoinColumn(name="sub_group_code", referencedColumnName="value_code")
     * @Groups({"product_read", "product_write", "translations"})
     */
    private $subGroupCode;


    /**
     * @Groups({"product_read"})
     */
    private $name;

    /**
     * @Groups({"product_write", "translations"})
     * @ORM\OneToMany(targetEntity="App\Entity\ProductTranslation", mappedBy="product", cascade={"persist", "remove"})
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

    public function getChildMinAge(): ?int
    {
        return $this->childMinAge;
    }

    public function setChildMinAge(?int $childMinAge): self
    {
        $this->childMinAge = $childMinAge;

        return $this;
    }

    public function getChildMaxAge(): ?int
    {
        return $this->childMaxAge;
    }

    public function setChildMaxAge(?int $childMaxAge): self
    {
        $this->childMaxAge = $childMaxAge;

        return $this;
    }

    public function getBabyMinAge(): ?int
    {
        return $this->babyMinAge;
    }

    public function setBabyMinAge(?int $babyMinAge): self
    {
        $this->babyMinAge = $babyMinAge;

        return $this;
    }

    public function getBabyMaxAge(): ?int
    {
        return $this->babyMaxAge;
    }

    public function setBabyMaxAge(?int $babyMaxAge): self
    {
        $this->babyMaxAge = $babyMaxAge;

        return $this;
    }

    public function getCallPriceBeforeDiscount(): ?int
    {
        return $this->callPriceBeforeDiscount;
    }

    public function setCallPriceBeforeDiscount(?int $callPriceBeforeDiscount): self
    {
        $this->callPriceBeforeDiscount = $callPriceBeforeDiscount;

        return $this;
    }

    public function getCallPrice(): ?int
    {
        return $this->callPrice;
    }

    public function setCallPrice(?int $callPrice): self
    {
        $this->callPrice = $callPrice;

        return $this;
    }

    public function getDiscountPourcentage(): ?string
    {
        return $this->discountPourcentage;
    }

    public function setDiscountPourcentage(?string $discountPourcentage): self
    {
        $this->discountPourcentage = $discountPourcentage;

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

    public function getOperator(): ?ThirdParty
    {
        return $this->operator;
    }

    public function setOperator(?ThirdParty $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function getGroupCode(): ?ParameterValue
    {
        return $this->groupCode;
    }

    public function setGroupCode(?ParameterValue $groupCode): self
    {
        $this->groupCode = $groupCode;

        return $this;
    }

    public function getSubGroupCode(): ?ParameterValue
    {
        return $this->subGroupCode;
    }

    public function setSubGroupCode(?ParameterValue $subGroupCode): self
    {
        $this->subGroupCode = $subGroupCode;

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


}
