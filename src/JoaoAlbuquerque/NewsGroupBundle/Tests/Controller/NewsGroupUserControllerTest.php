<?php

namespace JoaoAlbuquerque\NewsGroupBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsGroupUserControllerTest extends WebTestCase
{
    public function createAction(Request $request)
    {
        $this->assertCount(1, $crawler->filter('h1.title:contains("Hello World!")'));
    }

    public function newAction()
    {
        // Create a new client to browse the application
        $client = static::createClient();
        $crawler = $client->request('GET', '/newsgroupuser/new');

        // check that the page is the right one
        $this->assertCount(1, $crawler->filter('h1:contains("User News Group Registration")'));
        $this->assertCount(1, $crawler->filter('input.title:contains("Hello World!")'));
    }

    public function showAction($id)
    {

    }

    public function deleteAction($id)
    {
        // redirects to the login page
//        $crawler = $client->followRedirect();
    }
    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/newsgroupuser/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /newsgroupuser/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'joaoalbuquerque_newsgroupbundle_newsgroupusertype[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'joaoalbuquerque_newsgroupbundle_newsgroupusertype[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}
