<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Models;

interface UserInterface
{
    public function getName();
    public function getEmail();
    public function getPassword();
    public function setName($name);
    public function setEmail($email);
    public function setPassword($password);
}
