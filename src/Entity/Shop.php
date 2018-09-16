<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as ShopAssert;

use ReflectionClass;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
 */
class Shop implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string")
     * @ShopAssert\ConstrainsPostalcode()
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getStreet() . ', ' . $this->getPostalCode() . ' ' . $this->getCity() . ', France';
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

	/**
	 * @return string
	 */
	public function getAddress(): ?string
	{
		return $this->address;
	}

	/**
	 * @param string $address
	 * @return Shop
	 */
	public function setAddress(string $address): self
	{
		$this->address = $address;

		return $this;
	}

    /**
     * Specify data which should be serialized to JSON
     * @return string[]
     * @throws \ReflectionException
     */
    public function jsonSerialize()
    {
        $class      = new ReflectionClass($this);
        $properties = $class->getProperties();
        $results    = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            // Build getter method of the property
            $getter = 'get' . join(
                '', array_map('ucfirst', explode('_', $propertyName))
            );
            if (method_exists($this, $getter)) {
                $results[$property->getName()] = $this->$getter();
            }
        }
        return $results;
    }
}
