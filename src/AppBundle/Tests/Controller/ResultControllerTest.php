<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResultControllerTest extends WebTestCase
{
    public function testResult()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/result');
    }

}
