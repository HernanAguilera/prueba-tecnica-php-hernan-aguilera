<?php

use PHPUnit\Framework\TestCase;
use Faker\Factory;
use Hernanaguilera\PruebaTecnicaPhp\Dtos\Request;
use Hernanaguilera\PruebaTecnicaPhp\Repositories\InMemoryUserRepository;
use Hernanaguilera\PruebaTecnicaPhp\Repositories\InvalidDataException;
use Hernanaguilera\PruebaTecnicaPhp\UseCases\CreateUser;

class CreateUserTest extends TestCase
{
    protected $faker;
    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testCreateUserSuccessfully()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;

        $request = new Request();
        $request->setField('name', $name);
        $request->setField('email', $email);
        $request->setField('password', $password);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $userSaved = $user->execute($request);

        $userFound = $userRepository->getById($userSaved->getId());

        $this->assertEquals($name, $userFound->getName());
        $this->assertEquals($email, $userFound->getEmail());
        $this->assertEquals($password, $userFound->getPassword());
    }

    public function testCreateUserWithoutName()
    {
        $this->expectException(InvalidDataException::class);

        $email = $this->faker->email;
        $password = $this->faker->password;

        $request = new Request();
        $request->setField('email', $email);
        $request->setField('password', $password);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $user->execute($request);
    }

    public function testCreateUserWithoutEmail()
    {
        $this->expectException(InvalidDataException::class);

        $name = $this->faker->name;
        $password = $this->faker->password;

        $request = new Request();
        $request->setField('name', $name);
        $request->setField('password', $password);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $user->execute($request);
    }

    public function testCreateUserWithoutPassword()
    {
        $this->expectException(InvalidDataException::class);

        $name = $this->faker->name;
        $email = $this->faker->email;

        $request = new Request();
        $request->setField('name', $name);
        $request->setField('email', $email);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $user->execute($request);
    }

    public function testCreateUserWithEmptyName()
    {
        $this->expectException(InvalidDataException::class);

        $name = '';
        $email = $this->faker->email;
        $password = $this->faker->password;

        $request = new Request();
        $request->setField('name', $name);
        $request->setField('email', $email);
        $request->setField('password', $password);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $user->execute($request);
    }

    public function testCreateUserWithEmptyEmail()
    {
        $this->expectException(InvalidDataException::class);

        $name = $this->faker->name;
        $email = '';
        $password = $this->faker->password;

        $request = new Request();
        $request->setField('name', $name);
        $request->setField('email', $email);
        $request->setField('password', $password);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $user->execute($request);
    }

    public function testCreateUserWithEmptyPassword()
    {
        $this->expectException(InvalidDataException::class);

        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = '';

        $request = new Request();
        $request->setField('name', $name);
        $request->setField('email', $email);
        $request->setField('password', $password);

        $userRepository = new InMemoryUserRepository();
        $user = new CreateUser($userRepository);
        $user->execute($request);
    }
}
