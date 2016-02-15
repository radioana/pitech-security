<?php

namespace Pitech\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    public function testSuccessfulAuthentication()
    {
        $client = static::createClient();

        // get security users
        $userFetcher = $client->getContainer()->get('pitech_security.user_fetcher');
        $users = $userFetcher->getUsers();
        $this->assertNotEmpty($users);

        // get first user and use it's token to authenticate
        $user = current($users);
        $client->request('POST', '/', array('token' => $user->getToken()));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Hello World', $client->getResponse()->getContent());

        // make another request to make sure firewall is stateless
        $client->request('GET', '/');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    public function testUserNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/', array('token' => ''));
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
}
