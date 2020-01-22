<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations ={},
 *     itemOperations ={}
 *)
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ThirdParty")
     * @ORM\JoinColumn(name="third_party_id", referencedColumnName="id",nullable=true)
     */
    private $thirdParty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="business_unit_code", referencedColumnName="value_code")
     * @Groups({"read"})
     */
    private $businessUnit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MasterParameterValue")
     * @ORM\JoinColumn(name="civility_code", referencedColumnName="value_code",nullable=false)
     * @Groups({"read"})
     */
    private $civility;
    /**
     * @ORM\Column(type="string", length=100)
     * @ORM\JoinColumn(name="first_name")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @ORM\JoinColumn(name="last_name")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;
     /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean",options={"default" : 1})
     */
    private $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivility(): ?MasterParameterValue
    {
        return $this->civility;
    }

    public function setCivility(?MasterParameterValue $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getThirdParty(): ?ThirdParty
    {
        return $this->thirdParty;
    }

    public function setThirdParty(?ThirdParty $thirdParty): self
    {
        $this->thirdParty = $thirdParty;

        return $this;
    }

    public function getBusinessUnit(): ?MasterParameterValue
    {
        return $this->businessUnit;
    }

    public function setBusinessUnit(?MasterParameterValue $businessUnit): self
    {
        $this->businessUnit = $businessUnit;

        return $this;
    }
}
