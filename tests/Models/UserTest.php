<?php

use PHPUnit\Framework\TestCase;
use Faker\Factory;
use Hernanaguilera\PruebaTecnicaPhp\Models\User;

class UserTest extends TestCase
{
    protected $faker;
    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function test_create_user()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $user = new User($name, $email, $password);
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
    }

    public function test_set_user()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
    }
}
