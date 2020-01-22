<?php

namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiProperty;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalityTranslationRepository")
 * @ORM\Table(name="locality_transalation",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_locality_name", columns={"name", "locale"})})
 * @UniqueEntity(fields={"name","locale"})
 */
class LocalityTranslation extends AbstractTranslation
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Locality", inversedBy="translations")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(identifier=true)
     */
    private $locality;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"locality_read", "locality_write", "translations"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2)
     * @Groups({"locality_write", "translations"})
     * @ApiProperty(identifier=true)
     */
    protected $locale;


    public function getLocality(): ?Locality
    {
        return $this->locality;
    }

    public function setLocality(?Locality $locality): self
    {
        $this->locality = $locality;

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
