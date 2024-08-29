<?php

namespace Hernanaguilera\PruebaTecnicaPhp;

use Hernanaguilera\PruebaTecnicaPhp\Models\UserInterface;

class UserRepository implements Repositories\RepositoryInterface
{
    private $users = [];

    public function addUser(UserInterface $user)
    {
        $this->users[] = $user;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getUserByEmail($email)
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    public function deleteUserByEmail($email)
    {
        foreach ($this->users as $key => $user) {
            if ($user->getEmail() === $email) {
                unset($this->users[$key]);
            }
        }
    }

    public function updateUserByEmail($email, UserInterface $user)
    {
        foreach ($this->users as $key => $user) {
            if ($user->getEmail() === $email) {
                $this->users[$key] = $user;
            }
        }
    }
}
