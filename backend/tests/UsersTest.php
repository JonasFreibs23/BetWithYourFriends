<?php

use PHPUnit\Framework\TestCase;
require_once "core/bootstrap.php";

final class UsersTest extends TestCase
{
  private $name = 'todelete';
  private $email = 'todelete@delete.com';
  private $secret = 'secret';

  public function testCanSaveUserInDb()
  {
    $this->expectException(PDOException::class);

    $user = new Users();
    $user->setName($this->name);
    $user->setEmail($this->email);
    $hashedPassword = password_hash($this->secret, PASSWORD_DEFAULT);
    $user->setPassword($hashedPassword);
    $this->assertTrue($user->save());
  }

  public function testCanFetchValideUserByName()
  {
    $user = $this->fetchExistingUserByName($this->name);

    $this->assertEquals($this->name, $user->getName());
  }

  private function fetchExistingUserByName($name)
  {
    $user = new Users();
    $user->setName($name);
    $users = $user->getByName();
    return $users[0];
  }
}
