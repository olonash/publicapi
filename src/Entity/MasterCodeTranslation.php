<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MasterCodeTranslationRepository")
 */
class MasterCodeTranslation extends AbstractTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $code;
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=2)
     * @ApiProperty(identifier=true)
     * @Groups({"masterCode_write", "translations"})
     */
    protected $locale;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"masterCode_read", "masterCode_write", "translations"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterCode",cascade={"persist"}, inversedBy="translations")
     * @ORM\JoinColumn(name="code", referencedColumnName="code")
     */
    private $masterCode;

    public function getCode(): ?string
    {
        return $this->code;
    }
    
    public function getMasterCode(): ?MasterCode
    {
        return $this->masterCode;
    }

    public function setMasterCode(?MasterCode $masterCode): self
    {
        $this->masterCode = $masterCode;

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