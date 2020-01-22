<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations ={},
 *     itemOperations ={},
 *     attributes={
 *        "order"={"rank":"asc"},
 *        "filters"={"translation.groups"},
 *        "normalization_context"={"groups"={"masterParameterValue_read"}},
 *        "denormalization_context"={"groups"={"masterParameterValue_write"}}
 *     })
 * @ApiFilter(SearchFilter::class, properties={"parameter":"exact","objectCode":"exact","parentValueCode":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\MasterParameterValueRepository")
 */
class MasterParameterValue extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $valueCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessObject")
     * @ORM\JoinColumn(name="object_code", referencedColumnName="object_code",nullable=false)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $objectCode;


    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $rank;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $active; 

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parameter", inversedBy="masterParameterValues")
     * @ORM\JoinColumn(name="parameter_code", referencedColumnName="code",nullable=false)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $parameter;
    
    /**
     * @Groups({"masterParameterValue_read"})
     */
    private $name;
    
    /**
     * @Groups({"masterParameterValue_write", "translations"})
     * @ORM\JoinColumn(name="value_code", referencedColumnName="value_code")
     * @ORM\OneToMany(targetEntity="App\Entity\MasterParameterValueTranslation", mappedBy="masterParameterValue", cascade={"persist", "remove"})
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
   
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue", inversedBy="masterParameterValuesByParent")
     * @ORM\JoinColumn(name="parent_value_code", referencedColumnName="value_code",nullable=true)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $parentValueCode;



    public function getValueCode(): ?string
    {
        return $this->valueCode;
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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getParameter(): ?Parameter
    {
        return $this->parameter;
    }

    public function setParameter(?Parameter $parameter): self
    {
        $this->parameter = $parameter;

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
    protected function createTranslation():TranslationInterface
    {
        return new MasterParameterValueTranslation();
    }

    /**
     * @return Collection|MasterParameterValueTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }
    public function addTranslation(TranslationInterface $translation): void
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setMasterParameterValue($this);
        }
    }

    public function removeTranslation(TranslationInterface $translation): void
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getMasterParameterValue() === $this) {
                $translation->setMasterParameterValue(null);
            }
        }
    }

    public function getparentValueCode(): ?self
    {
        return $this->parentValueCode;
    }

    public function setparentValueCode(?self $parentValueCode): self
    {
        $this->parentValueCode = $parentValueCode;

        return $this;
    }

   
   
  
   



}
