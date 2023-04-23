<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Responce;

class MainPageControllerTest extends WebTestCase
{
    public function testPageIsSuccessful()
    {
        $client = self::createClient();
        $client->request('GET', "/");

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}