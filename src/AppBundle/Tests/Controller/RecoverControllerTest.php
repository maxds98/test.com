<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecoverControllerTest extends WebTestCase
{
    public function testRecover()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/recover');
    }

}
