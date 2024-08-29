<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Repositories;

use Hernanaguilera\PruebaTecnicaPhp\Models\UserInterface;

interface RepositoryInterface
{
    public function addUser(UserInterface $user);
    public function getUsers();
    public function getUserByEmail($email);
    public function deleteUserByEmail($email);
    public function updateUserByEmail($email, UserInterface $user);
}
