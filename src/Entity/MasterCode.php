<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={},
 *     itemOperations={}
 *     )
 * @ApiFilter(BooleanFilter::class, properties={"isTenantParameter","isBusinessObject"})
 * @ORM\Entity(repositoryClass="App\Repository\MasterCodeRepository")
 */
class MasterCode  extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $code;

    /**
     * @ORM\Column(type="boolean",options={"default" : 0})
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $isMasterParameter;

    /**
     * @ORM\Column(type="boolean",options={"default" : 0})
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $isTenantParameter;

    /**
     * @ORM\Column(type="boolean",options={"default" : 0})
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $isMasterParameterValue;

    /**
     * @ORM\Column(type="boolean",options={"default" : 0})
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $isBusinessObject;

    /**
     * @ORM\Column(type="boolean",options={"default" : 0})
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $isAttribute;

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $active;
    
    /**
     * @Groups({"masterCode_read"})
     * @Groups({"TenantParameterValue_read","TenantParameterValue_write", "translations"}) 
     */
    private $name;
    
     /**
     * @Groups({"masterCode_write", "translations"})
     * @ORM\JoinColumn(name="code", referencedColumnName="code")
     * @ORM\OneToMany(targetEntity="App\Entity\MasterCodeTranslation", mappedBy="masterCode", cascade={"persist", "remove"})
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

    

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getIsMasterParameter(): ?bool
    {
        return $this->isMasterParameter;
    }

    public function setIsMasterParameter(bool $isMasterParameter): self
    {
        $this->isMasterParameter = $isMasterParameter;

        return $this;
    }

    public function getIsTenantParameter(): ?bool
    {
        return $this->isTenantParameter;
    }

    public function setIsTenantParameter(bool $isTenantParameter): self
    {
        $this->isTenantParameter = $isTenantParameter;

        return $this;
    }

    public function getIsMasterParameterValue(): ?bool
    {
        return $this->isMasterParameterValue;
    }

    public function setisMasterParameterValue(bool $isMasterParameterValue): self
    {
        $this->isMasterParameterValue = $isMasterParameterValue;

        return $this;
    }

    public function getIsBusinessObject(): ?bool
    {
        return $this->isBusinessObject;
    }

    public function setIsBusinessObject(bool $isBusinessObject): self
    {
        $this->isBusinessObject = $isBusinessObject;

        return $this;
    }

    public function getIsAttribute(): ?bool
    {
        return $this->isAttribute;
    }

    public function setIsAttribute(bool $isAttribute): self
    {
        $this->isAttribute = $isAttribute;

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
    
    protected function createTranslation():TranslationInterface
    {
        return new MasterCodeTranslation();
    }

    /**
     * @return Collection|MasterCodeTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }
    public function addTranslation(TranslationInterface $translation): void
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setMasterCode($this);
        }
    }

    public function removeTranslation(TranslationInterface $translation): void
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getMasterCode() === $this) {
                $translation->setMasterCode(null);
            }
        }
    }

}
