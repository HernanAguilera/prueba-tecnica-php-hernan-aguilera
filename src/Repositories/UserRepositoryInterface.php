<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Repositories;

use Hernanaguilera\PruebaTecnicaPhp\Models\User;

interface UserRepositoryInterface
{
    public function save(User $intance): User;
    public function getById(string $id): ?User;
    public function getAll(): array;
    public function update(string $id, User $instance): ?User;
    public function delete(string $id): bool;
}
