<?php

namespace App\Entity\Client;

use App\Component\Model\AddressInterface;
use App\Component\Model\CustomerInterface;
use App\Component\Model\ShopUserInterface;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use KunicMarko\SonataAnnotationBundle\Annotation\Admin;
use Sylius\Component\User\Model\UserInterface as BaseUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Webmozart\Assert\Assert;

/**
 * Class Customer
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_client_customer")
 * @ORM\HasLifecycleCallbacks()
 *
 * @UniqueEntity(fields={"email"})
 * @UniqueEntity(fields={"phoneNumber"})
 *
 * @Admin(
 *     label="Customer",
 *     icon="<i class='fa fa-user'></i>",
 *     group="Users",
 *     admin="App\Admin\Client\CustomerAdmin"
 * )
 */
class Customer implements CustomerInterface
{
    use TimestampableTrait;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $emailCanonical;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $birthday;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true, length=14, unique=true)
     */
    private $phoneNumber;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $subscribedToNewsletter = false;

//    /**
//     * @var Collection|OrderInterface[]
//     */
//    private $orders;

    /**
     * @var AddressInterface
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Address")
     */
    private $defaultAddress;

    /**
     * @var Collection|AddressInterface[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Address", mappedBy="customer")
     */
    private $addresses;

    /**
     * @var ShopUserInterface
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\ShopUser", inversedBy="customer", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    public function __construct()
    {
//        $this->orders = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getEmail();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailCanonical(): ?string
    {
        return $this->emailCanonical;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailCanonical(?string $emailCanonical): void
    {
        $this->emailCanonical = $emailCanonical;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName(): string
    {
        return trim(sprintf('%s %s', $this->firstName, $this->lastName));
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * {@inheritdoc}
     */
    public function setBirthday(?\DateTimeInterface $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function isSubscribedToNewsletter(): bool
    {
        return $this->subscribedToNewsletter;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubscribedToNewsletter(bool $subscribedToNewsletter): void
    {
        $this->subscribedToNewsletter = $subscribedToNewsletter;
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function getOrders(): Collection
//    {
//        return $this->orders;
//    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultAddress(): ?AddressInterface
    {
        return $this->defaultAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultAddress(?AddressInterface $defaultAddress): void
    {
        $this->defaultAddress = $defaultAddress;

        if (null !== $defaultAddress) {
            $this->addAddress($defaultAddress);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addAddress(AddressInterface $address): void
    {
        if (!$this->hasAddress($address)) {
            $this->addresses[] = $address;
            $address->setCustomer($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAddress(AddressInterface $address): void
    {
        $this->addresses->removeElement($address);
        $address->setCustomer(null);
    }

    /**
     * {@inheritdoc}
     */
    public function hasAddress(AddressInterface $address): bool
    {
        return $this->addresses->contains($address);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): ?BaseUserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(?BaseUserInterface $user): void
    {
        if ($this->user === $user) {
            return;
        }

        /** @var ShopUserInterface|null $user */
        Assert::nullOrIsInstanceOf($user, ShopUserInterface::class);

        $previousUser = $this->user;
        $this->user = $user;

        if ($previousUser instanceof ShopUserInterface) {
            $previousUser->setCustomer(null);
        }

        if ($user instanceof ShopUserInterface) {
            $user->setCustomer($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasUser(): bool
    {
        return null !== $this->user;
    }
}
