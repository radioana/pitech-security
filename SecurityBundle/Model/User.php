<?php

namespace Pitech\SecurityBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $username;

    private $token;

    private $roles;

    public function __construct($username, $token, array $roles)
    {
        $this->username = $username;
        $this->token = $token;
        $this->roles = $roles;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }
}
