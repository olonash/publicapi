<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TenantExcludedMasterCodeRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="uniq_tenant_excluded_code", columns={"tenant_id", "code"})})
 */
class TenantExcludedMasterCode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tenant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tenant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterCode")
     * @ORM\JoinColumn(name="code", referencedColumnName="code",nullable=false)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCode(): ?MasterCode
    {
        return $this->code;
    }

    public function setCode(?MasterCode $code): self
    {
        $this->code = $code;

        return $this;
    }
}
