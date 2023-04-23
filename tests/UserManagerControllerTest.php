<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Responce;

class UserManagerControllerTest extends WebTestCase
{
    private $client;
    public function loginUser()
    {
        $this->client = self::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@example.com');
        $this->client->loginUser($testUser);
    }
    public function testPageIndexIsSuccessful()
    {
        $this->loginUser();
        $this->client->request('GET', "/admin/users");
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
    public function testPageAddIsSuccessful()
    {
        $this->loginUser();
        $this->client->request('GET', "/admin/users/add");
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}