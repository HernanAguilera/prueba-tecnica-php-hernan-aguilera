<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Repositories;

use Hernanaguilera\PruebaTecnicaPhp\Models\User;
use Hernanaguilera\PruebaTecnicaPhp\Repositories\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    private $users = [];

    public function __construct()
    {
        $this->users = [];
    }

    public function save(User $user): User
    {
        $this->validateData([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
        $this->users[] = $user;
        return $user;
    }

    public function getById(string $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }

        return null;
    }

    public function getByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    public function getAll(): array
    {
        return $this->users;
    }

    public function getUserByEmail($email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    public function delete($email): bool
    {
        foreach ($this->users as $key => $user) {
            if ($user->getEmail() === $email) {
                unset($this->users[$key]);
                return true;
            }
        }
        return false;
    }

    public function update($email, User $user): ?User
    {
        $this->validateData([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
        foreach ($this->users as $key => $user) {
            if ($user->getEmail() === $email) {
                $this->users[$key] = $user;
                return $user;
            }
        }
        return null;
    }

    private function validateData($data)
    {
        if (!isset($data['name']) || $data['name'] === '') {
            throw new InvalidDataException("Name is required");
        }

        if (!isset($data['email']) || $data['email'] === '') {
            throw new InvalidDataException("Email is required");
        }

        if (!isset($data['password']) || $data['password'] === '') {
            throw new InvalidDataException("Password is required");
        }
    }
}
