<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={},
 *     itemOperations={}
 *     )
 * @ApiFilter(SearchFilter::class, properties={"object":"exact","objectId":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ObjectDetailRepository")
 */
class ObjectDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessObject")
     * @ORM\JoinColumn(name="object_code", referencedColumnName="object_code",nullable=false)
     */
    private $object;

    /**
     * @ORM\Column(type="integer")
     */
    private $objectId;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue")
     * @ORM\JoinColumn(nullable=true)
     */
    private $group;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="locale_code", referencedColumnName="value_code",nullable=false)
     */
    private $locale;

   /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id", nullable=true)
     */
    private $tenant;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    public function setObjectId(int $objectId): self
    {
        $this->objectId = $objectId;

        return $this;
    }




    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getGroup(): ?TenantParameterValue
    {
        return $this->group;
    }

    public function setGroup(?TenantParameterValue $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getLocale(): ?MasterParameterValue
    {
        return $this->locale;
    }

    public function setLocale(?MasterParameterValue $locale): self
    {
        $this->locale = $locale;

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
}
