<?php

namespace WCS\TvShowManagerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EpisodeControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/episode/list');
    }

    public function testModif()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/episode/modif');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/episode/add');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/episode/delete');
    }

}
