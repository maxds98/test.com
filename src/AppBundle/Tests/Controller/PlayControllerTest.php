<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayControllerTest extends WebTestCase
{
    public function testQuizzes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/quizzes');
    }

}
