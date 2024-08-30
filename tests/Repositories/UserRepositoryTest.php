<?php

use Hernanaguilera\PruebaTecnicaPhp\Repositories\InMemoryUserRepository as UserRepository;
use PHPUnit\Framework\TestCase;
use Faker\Factory;
use Hernanaguilera\PruebaTecnicaPhp\Models\User;
use Hernanaguilera\PruebaTecnicaPhp\Repositories\InvalidDataException;

class UserRepositoryTest extends TestCase
{
    protected $faker;
    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testSaveUser()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($name, $email, $password));
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
    }

    public function testGetUserById()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($name, $email, $password));
        $userById = $userRepository->getById($user->getId());
        $this->assertEquals($user, $userById);
    }

    public function testGetUserByEmail()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($name, $email, $password));
        $userByEmail = $userRepository->getByEmail($user->getEmail());
        $this->assertEquals($user, $userByEmail);
    }

    public function testGetAllUsers()
    {
        $userRepository = new UserRepository();
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $name = $this->faker->name;
            $email = $this->faker->email;
            $password = $this->faker->password;
            $users[] = $userRepository->save(new User($name, $email, $password));
        }
        $allUsers = $userRepository->getAll();
        $this->assertEquals($users, $allUsers);
    }

    public function testUpdateUser()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($name, $email, $password));
        $newName = $this->faker->name;
        $newEmail = $this->faker->email;
        $newPassword = $this->faker->password;
        $user->setName($newName);
        $user->setEmail($newEmail);
        $user->setPassword($newPassword);
        $userRepository->update($user->getId(), $user);
        $updatedUser = $userRepository->getById($user->getId());
        $this->assertEquals($newName, $updatedUser->getName());
        $this->assertEquals($newEmail, $updatedUser->getEmail());
        $this->assertEquals($newPassword, $updatedUser->getPassword());
    }

    public function testDeleteUser()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($name, $email, $password));
        $userRepository->delete($user->getEmail());
        $deletedUser = $userRepository->getByEmail($user->getEmail());
        $this->assertNull($deletedUser);
    }

    public function testGetUserByEmailWhenUserDoesNotExist()
    {
        $userRepository = new UserRepository();
        $userByEmail = $userRepository->getByEmail($this->faker->email);
        $this->assertNull($userByEmail);
    }

    public function testGetUserByIdWhenUserDoesNotExist()
    {
        $userRepository = new UserRepository();
        $userById = $userRepository->getById($this->faker->uuid);
        $this->assertNull($userById);
    }

    public function testDeleteUserWhenUserDoesNotExist()
    {
        $userRepository = new UserRepository();
        $result = $userRepository->delete($this->faker->email);
        $this->assertFalse($result);
    }

    public function testUpdateUserWhenUserDoesNotExist()
    {
        $userRepository = new UserRepository();
        $user = new User($this->faker->name, $this->faker->email, $this->faker->password);
        $result = $userRepository->update($this->faker->uuid, $user);
        $this->assertNull($result);
    }

    public function testGetAllUsersWhenThereAreNoUsers()
    {
        $userRepository = new UserRepository();
        $allUsers = $userRepository->getAll();
        $this->assertEmpty($allUsers);
    }

    public function testSaveUserWithEmptyName()
    {
        $userRepository = new UserRepository();
        $this->expectException(InvalidDataException::class);
        $userRepository->save(new User('', $this->faker->email, $this->faker->password));
    }

    public function testSaveUserWithEmptyEmail()
    {
        $userRepository = new UserRepository();
        $this->expectException(InvalidDataException::class);
        $userRepository->save(new User($this->faker->name, '', $this->faker->password));
    }

    public function testSaveUserWithEmptyPassword()
    {
        $userRepository = new UserRepository();
        $this->expectException(InvalidDataException::class);
        $userRepository->save(new User($this->faker->name, $this->faker->email, ''));
    }

    public function testUpdateUserWithEmptyName()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($this->faker->name, $this->faker->email, $this->faker->password));
        $this->expectException(InvalidDataException::class);
        $user->setName('');
        $userRepository->update($user->getId(), $user);
    }

    public function testUpdateUserWithEmptyEmail()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($this->faker->name, $this->faker->email, $this->faker->password));
        $this->expectException(InvalidDataException::class);
        $user->setEmail('');
        $userRepository->update($user->getId(), $user);
    }

    public function testUpdateUserWithEmptyPassword()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->save(new User($this->faker->name, $this->faker->email, $this->faker->password));
        $this->expectException(InvalidDataException::class);
        $user->setPassword('');
        $userRepository->update($user->getId(), $user);
    }
}
