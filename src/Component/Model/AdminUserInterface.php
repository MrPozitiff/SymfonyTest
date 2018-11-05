<?php
/** */
namespace App\Component\Model;

use Sylius\Component\User\Model\UserInterface as BaseUserInterface;

/**
 * Interface SonataUserInterface
 */
interface AdminUserInterface extends BaseUserInterface
{
    const ROLE_DEFAULT = 'ROLE_USER';

    /**
     * @return string
     */
    public function getFirstName(): ?string;
    /**
     * @param string $firstName
     */
    public function setFirstName(?string $firstName): void;
    /**
     * @return string
     */
    public function getLastName(): ?string;
    /**
     * @param string $lastName
     */
    public function setLastName(?string $lastName): void;
    /**
     * @return string
     */
    public function getLocaleCode(): ?string;
    /**
     * @param string $code
     */
    public function setLocaleCode(string $code);
}
