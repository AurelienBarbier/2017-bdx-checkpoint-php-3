<?php

namespace WCS\TvShowManagerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TvShowControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tvshow/list');
    }

    public function testModif()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tvshow/modif');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tvshow/add');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tvshow/delete');
    }

}
