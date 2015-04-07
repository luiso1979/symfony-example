<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BootyControllerTest extends WebTestCase
{
    public function testObjects4TreasureOK()
    {
        $client = static::createClient();

        $client->request('GET', '/objects4Treasure/1');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertRegExp('/{"totale":.*}/', $client->getResponse()->getContent());
    }

    public function testObjects4TreasureNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/objects4Treasure/100');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"Problems with the treasure: 100"', $client->getResponse()->getContent());
    }

    public function testObjects4TreasureNotNumeric()
    {
        $client = static::createClient();

        $client->request('GET', '/objects4Treasure/a');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"The treasure ID must be numeric (e.g \/objects4Treasure\/1)."', $client->getResponse()->getContent());

        $client->request('GET', '/objects4Treasure');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"The treasure ID must be numeric (e.g \/objects4Treasure\/1)."', $client->getResponse()->getContent());
    }

    public function testValue4TreasureOK()
    {
        $client = static::createClient();

        $client->request('GET', '/value4Treasure/1');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertRegExp('/{"valore":.*}/', $client->getResponse()->getContent());
    }

    public function testValue4TreasureNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/value4Treasure/100');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"Problems with the treasure: 100"', $client->getResponse()->getContent());
    }

    public function testValue4TreasureNotNumeric()
    {
        $client = static::createClient();

        $client->request('GET', '/value4Treasure/a');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"The treasure ID must be numeric (e.g \/value4Treasure\/1)."', $client->getResponse()->getContent());

        $client->request('GET', '/value4Treasure');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"The treasure ID must be numeric (e.g \/value4Treasure\/1)."', $client->getResponse()->getContent());
    }

    public function testMostWantedOK()
    {
        $client = static::createClient();

        $client->request('GET', '/mostWanted');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertRegExp('/{"oggetto":.*,"quantita":.*}/', $client->getResponse()->getContent());
    }

    public function testMostWanted4TreasureOK()
    {
        $client = static::createClient();

        $client->request('GET', '/mostWanted4Treasure/1');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertRegExp('/{"oggetto":.*,"quantita":.*}/', $client->getResponse()->getContent());
    }

    public function testMostWanted4TreasureNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/mostWanted4Treasure/100');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"Problems with the treasure: 100"', $client->getResponse()->getContent());
    }

    public function testMostWanted4TreasureNotNumeric()
    {
        $client = static::createClient();

        $client->request('GET', '/mostWanted4Treasure/a');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"The treasure ID must be numeric (e.g \/mostWanted4Treasure\/1)."', $client->getResponse()->getContent());

        $client->request('GET', '/mostWanted4Treasure');

        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
        $this->assertSame('"The treasure ID must be numeric (e.g \/mostWanted4Treasure\/1)."', $client->getResponse()->getContent());
    }
}
