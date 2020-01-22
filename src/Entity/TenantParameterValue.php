<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={},
 *     itemOperations={},
 *     attributes={
 *        "filters"={"translation.groups"},
 *        "normalization_context"={"groups"={"TenantParameterValue_read"}},
 *        "denormalization_context"={"groups"={"TenantParameterValue_write"}}
 *     }) 
 * @ApiFilter(SearchFilter::class, properties={"tenant":"exact","parameter":"exact","object":"exact","parentValue":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\TenantParameterValueRepository")
 * @ORM\Table(name="tenant_parameter_value",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_parameterValueTenant", columns={"value_code", "tenant_id"})})
 */
class TenantParameterValue extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"TenantParameterValue_read", "translations"})
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $valueCode;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id",nullable=false)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $tenant;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterCode")
     * @ORM\JoinColumn(name="parameter_code", referencedColumnName="code",nullable=false)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $parameter;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessObject")
     * @ORM\JoinColumn(name="object_code", referencedColumnName="object_code",nullable=false)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $object;

    
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $rank;

    /**
     * @ORM\Column(type="boolean", options={"default" : 1})
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $active;

   
     /**
     * @Groups({"TenantParameterValue_read","media_read"}) 
     */
    private $name;
    
     /**
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     * @ORM\JoinColumn(name="value_code", referencedColumnName="value_code")
     * @ORM\OneToMany(targetEntity="App\Entity\TenantParameterValueTranslation", mappedBy="tenantParameterValue", cascade={"persist", "remove"})
     */
    protected $translations;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue", inversedBy="tenantParameterValuesByParent")
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $parentValue;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $public;

    

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
   
    public function getValueCode(): ?string
    {
        return $this->valueCode;
    }

    public function setValueCode(?string $valueCode): self
    {
        $this->valueCode = $valueCode;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(?int $rank): self
    {
        $this->rank = $rank;

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getParameter(): ?MasterCode
    {
        return $this->parameter;
    }

    public function setParameter(?MasterCode $parameter): self
    {
        $this->parameter = $parameter;

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
    protected function createTranslation():TranslationInterface
    {
        return new TenantParameterValueTranslation();
    }

    /**
     * @return Collection|TenantParameterValueTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }
    public function addTranslation(TranslationInterface $translation): void
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setTenantParameterValue($this);
        }
    }

    public function removeTranslation(TranslationInterface $translation): void
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getTenantParameterValue() === $this) {
                $translation->setTenantParameterValue(null);
            }
        }
    }


    public function getParentValue(): ?self
    {
        return $this->parentValue;
    }

    public function setParentValue(?self $parentValue): self
    {
        $this->parentValue = $parentValue;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

   
   
   
  
   



}
