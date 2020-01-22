<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MasterParameterValueTranslationRepository")
 */
class MasterParameterValueTranslation extends AbstractTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $ValueCode;
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=2)
     * @ApiProperty(identifier=true)
     * @Groups({"masterParameterValue_write", "translations"})
     */
    protected $locale;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"masterParameterValue_read", "masterParameterValue_write", "translations"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue",cascade={"persist"}, inversedBy="translations")
     * @ORM\JoinColumn(name="value_code", referencedColumnName="value_code")
     */
    private $masterParameterValue;



    public function getMasterParameterValue(): ?MasterParameterValue
    {
        return $this->masterParameterValue;
    }

    public function setMasterParameterValue(?MasterParameterValue $masterParameterValue): self
    {
        $this->masterParameterValue = $masterParameterValue;

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
    public function getValueCode(): ?string
    {
        return $this->ValueCode;
    }
}