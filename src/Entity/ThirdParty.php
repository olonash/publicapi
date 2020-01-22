<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(formats={"json"})
 * @ApiFilter(SearchFilter::class, properties={"name": "partial","relationType":"exact","organization":"exact","active":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ThirdPartyRepository")
 */
class ThirdParty
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     */
    private $organization;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="relation_type_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"read"})
     */
    private $relationType;
     /**
     * @ORM\Column(type="boolean",options={"default" : 0})
     */
    private $operator;

 
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterValue")
     * @ORM\JoinColumn(name="group_code", referencedColumnName="value_code",nullable=true)
     * @Groups({"read"})
     */
    private $groupCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterValue")
     * @ORM\JoinColumn(name="sub_group_code", referencedColumnName="value_code",nullable=true)
     * @Groups({"read"})
     */
    private $subGroupCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="civility_code", referencedColumnName="value_code",nullable=true)
     * @Groups({"read"})
     */
    private $civility;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"read"})
     */
    private $email;


    
    

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     */
    private $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

   /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="supplier")
     */
    private $products;

    public function __construct()
    {
        
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivility(): ?MasterParameterValue
    {
        return $this->civility;
    }

    public function setCivility(?MasterParameterValue $civility): self
    {
        $this->civility = $civility;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setfirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getorganization(): ?bool
    {
        return $this->organization;
    }

    public function setorganization(bool $organization): self
    {
        $this->organization = $organization;

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

    public function getRelationType(): ?MasterParameterValue
    {
        return $this->relationType;
    }

    public function setRelationType(?MasterParameterValue $relationType): self
    {
        $this->relationType = $relationType;

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

    
    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setSupplier($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getSupplier() === $this) {
                $product->setSupplier(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getOperator(): ?bool
    {
        return $this->operator;
    }

    public function setOperator(bool $operator): self
    {
        $this->operator = $operator;

        return $this;
    }
}
