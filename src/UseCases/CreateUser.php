<?php

namespace Hernanaguilera\PruebaTecnicaPhp\UseCases;

use Hernanaguilera\PruebaTecnicaPhp\Dtos\Request;
use Hernanaguilera\PruebaTecnicaPhp\Models\User;
use Hernanaguilera\PruebaTecnicaPhp\Repositories\UserRepositoryInterface;

class CreateUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(Request $request)
    {
        $name = $request->getField('name');
        $email = $request->getField('email');
        $password = $request->getField('password');
        $user = new User($name, $email, $password);
        return $this->userRepository->save($user);
    }
}
