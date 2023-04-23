<?php
namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Responce;

class AdminPageControllerTest extends WebTestCase
{
    private $client;
    public function loginUser()
    {
        $this->client = self::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@example.com');
        $this->client->loginUser($testUser);
    }
    public function testMainPageIsSuccessful()
    {
        $this->loginUser();
        $this->client->request('GET', "/admin");
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
    public function testMainPageExamsIsSuccessful()
    {
        $this->loginUser();
        $this->client->request('GET', "/admin/exam");
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
    public function testMainPageExamIsSuccessful()
    {
        $this->loginUser();
        $this->client->request('GET', "/admin/exam/1");
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
    // public function testEditPageExamIsSuccessful()
    // {
    //     $this->loginUser();
    //     $this->client->request('GET', "/admin/exam/edit/1");
    //     $this->assertTrue($this->client->getResponse()->isSuccessful());
    // }
}