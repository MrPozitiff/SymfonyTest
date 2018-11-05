<?php
/** */
namespace App\Entity\Admin;

use App\Component\SonataUserInterface;
use Doctrine\ORM\Mapping as ORM;
use KunicMarko\SonataAnnotationBundle\Annotation\Admin;
use KunicMarko\SonataAnnotationBundle\Annotation\FormField;
use KunicMarko\SonataAnnotationBundle\Annotation\ListField;
use Sylius\Component\User\Model\User;

/**
 * Class SonataUser
 *
 * @ORM\Entity(repositoryClass="App\Repository\Admin\SonataUserRepository")
 * @ORM\Table(name="app_admin_user")
 *
 * @Admin(
 *     label="Administrators",
 *     icon="<i class='fa fa-user'></i>",
 * )
 */
class SonataUser extends User implements SonataUserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     *
     * @FormField()
     * @ListField()
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     *
     * @FormField()
     * @ListField()
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    protected $localeCode;

    public function __construct()
    {
        parent::__construct();
        $this->roles = [SonataUserInterface::DEFAULT_ADMIN_ROLE];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $names = [];
        if ($this->getFirstName()) {
            $names[] = $this->getFirstName();
        }
        if ($this->getLastName()) {
            $names[] = $this->getLastName();
        }
        if ($names) {
            return implode(' ', $names);
        } elseif ($this->getUsername()) {
            return (string) $this->getUsername();
        } else {
            return (string) $this->getEmail();
        }
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
    public function getLocaleCode(): ?string
    {
        return $this->localeCode;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocaleCode(string $code)
    {
        $this->localeCode = $code;
    }

    /**
     * @return array The roles
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the SecurityContext, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $securityContext->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function isLocked(): bool
    {
        return (bool) $this->locked;
    }

    /**
     * {@inheritdoc}
     */
    public function isExpired(): bool
    {
        return (bool) ($this->expiresAt !== null ? $this->expiresAt < new \DateTime() : false);
    }
}
