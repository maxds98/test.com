<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CheckAnswerControllerTest extends WebTestCase
{
    public function testCheckanswer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/checkAnswer');
    }

}
