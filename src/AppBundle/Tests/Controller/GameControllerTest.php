<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testPlay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/play');
    }

}
