<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterValueTranslationRepository")
 */
class ParameterValueTranslation extends AbstractTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     * @Groups({"parameterValue_read", "parameterValue_write", "translations"})
     */
    private $ValueCode;
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=2)
     * @ApiProperty(identifier=true)
     * @Groups({"parameterValue_write", "translations"})
     */
    protected $locale;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"parameterValue_read", "parameterValue_write", "translations"})
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterValue",cascade={"persist"}, inversedBy="translations")
     * @ORM\JoinColumn(name="value_code", referencedColumnName="value_code")
     */
    private $parameterValue;


    public function getParameterValue(): ?ParameterValue
    {
        return $this->parameterValue;
    }

    public function setParameterValue(?ParameterValue $parameterValue): self
    {
        $this->parameterValue = $parameterValue;

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