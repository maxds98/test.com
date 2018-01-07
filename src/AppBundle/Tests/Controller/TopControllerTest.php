<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TopControllerTest extends WebTestCase
{
    public function testTop()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/top');
    }

}
