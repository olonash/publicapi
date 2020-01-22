<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={},
 *     itemOperations={},
 *     attributes={
 *        "normalization_context"={"groups"={"media_read"}},
 *        "denormalization_context"={"groups"={"media_write"}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class,properties={"tenant":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 * @ORM\Table(name="media",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_MediaTenant", columns={"url", "tenant_id"})})
 */
class Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"media_write", "media_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400)
     * @Groups({"media_write", "media_read"})
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id",nullable=false)
     * @Groups({"media_write", "media_read"})
     */
    private $tenant;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="type_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"media_write", "media_read"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue")
     * @Groups({"media_write", "media_read"})
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TenantParameterValue")
     * @Groups({"media_write", "media_read"})
     */
    private $subGroup;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getGroup(): ?TenantParameterValue
    {
        return $this->group;
    }

    public function setGroup(?TenantParameterValue $group): self
    {
        $this->groupId = $group;

        return $this;
    }

    public function getSubGroup(): ?TenantParameterValue
    {
        return $this->subGroup;
    }

    public function setSubGroup(?TenantParameterValue $subGroup): self
    {
        $this->subGroup = $subGroup;

        return $this;
    }

    public function getType(): ?MasterParameterValue
    {
        return $this->type;
    }

    public function setType(?MasterParameterValue $type): self
    {
        $this->type = $type;

        return $this;
    }
}
