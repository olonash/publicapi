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
 * @ORM\Entity(repositoryClass="App\Repository\ObjectMediaRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="uniq_tenant_media_object", columns={"media_id", "object_id","object_code"})})
 */
class ObjectMedia
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
     * @ORM\ManyToOne(targetEntity="App\Entity\media")
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rank;

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

    public function getMedia(): ?media
    {
        return $this->media;
    }

    public function setMedia(?media $media): self
    {
        $this->media = $media;

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
}
