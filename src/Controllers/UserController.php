<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Controllers;

use Hernanaguilera\PruebaTecnicaPhp\Dtos\Request;
use Hernanaguilera\PruebaTecnicaPhp\UseCases\CreateUser;

class UserController
{

    public function save(Request $request, CreateUser $createUser)
    {
        $createUser->execute($request);
    }
}
