<?php

namespace Pitech\SecurityBundle\Fetcher;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Pitech\SecurityBundle\Model\User;

class UserFetcher
{
    public function __construct(array $users)
    {
        $this->users = [];
        foreach ($users as $name => $data) {
            if (empty($data['token']) || !array_key_exists('roles', $data) || !is_array($data['roles'])) {
                continue;
            }

            $token = $data['token'];
            $this->users[$token] = new User($name, $token, $data['roles']);
        }
    }

    /**
     * Return all users.
     * @return array
     */
    public function getUsers()
    {
        return array_values($this->users);
    }

    /**
     * Get user, if any, for the provided token.
     * @param  string $token
     * @return User|null
     */
    public function getUserByToken($token)
    {
        return array_key_exists($token, $this->users) ? $this->users[$token] : null;
    }
}
