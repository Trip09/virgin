<?php

namespace JoaoAlbuquerque\NewsGroupBundle\Tests\Controller;

use JoaoAlbuquerque\NewsGroupBundle\Entity\NewsGroupUser;
use JoaoAlbuquerque\NewsGroupBundle\Manager\NewsGroupUser as ManagerNewsGroupUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsGroupUserControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();
        $crawler = $client->request('GET', '/newsgroupuser/create');
        $this->assertTrue($client->getResponse()->isSuccessful());

        // check that the page is the right one
        $this->assertCount(1, $crawler->filter('h1:contains("User News Group Registration")'));
        $this->assertCount(1, $crawler->filter('input[type="email"]'));

        $email = time() . 'Test@test.com';
        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'joaoalbuquerque_newsgroupbundle_newsgroupuser[email]'  => $email
        ));
        $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for POST /newsgroupuser/create");

        $crawler = $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful());

        // check that the page is the right one
        $this->assertCount(1, $crawler->filter('table')->filter('td:contains("' . $email . '")'));

        // Test Add a friend button
        $link = $crawler->filter('a:contains("Add a friend")')->eq(0)->link();
        $client->click($link);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $client->getHistory()->back();

        // Test Delete
        $link = $crawler->filter('a:contains("Unsubscribe")')->eq(0)->link();
        $client->click($link);
        $this->assertEquals(302, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /newsgroupuser/delete");
    }
}
