<?php
namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Responce;

class SecurityControllerTest extends WebTestCase
{
    public function testPageIsSuccessful()
    {
        $client = self::createClient();
        $client->request('GET', '/login');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    //TODO Dorobić test Logowania na wszystkie konta testowe
    public function testLoginIsSuccessful()
    {
        $client = self::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@example.com');
        $client->loginUser($testUser);
        $client->request('GET','/admin');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    public function testLogout(){
        $client = self::createClient();
        $client->request('GET','/logout');
        $this->assertResponseRedirects('http://localhost/');
    }
    public function testLogoutIntegrity(){
        $client = self::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@example.com');
        $client->loginUser($testUser);
        $client->request('GET','/logout');
        $this->assertResponseRedirects('http://localhost/');
    }
}