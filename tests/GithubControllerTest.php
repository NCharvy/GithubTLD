<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GithubControllerTest extends WebTestCase
{
    public function testGithubApi()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/NCharvy/GithubTLD');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
