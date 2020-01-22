<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TenantParameterValueTranslationRepository")
 * @ORM\Table(name="tenant_parameter_value_translation",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_tenant_parameter_value_name", columns={"value_id", "locale"})})
 */
class TenantParameterValueTranslation extends AbstractTranslation
{
   /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    protected $locale;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"TenantParameterValue_read", "TenantParameterValue_write", "translations"})
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue",cascade={"persist"}, inversedBy="translations")
     * @ORM\JoinColumn(name="value_id", referencedColumnName="id")
     */
    private $tenantParameterValue;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTenantParameterValue(): ?TenantParameterValue
    {
        return $this->tenantParameterValue;
    }

    public function setTenantParameterValue(?TenantParameterValue $tenantParameterValue): self
    {
        $this->tenantParameterValue = $tenantParameterValue;

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

    
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    
   
}