<?php

namespace Tests\Unit\Access\Tattooist;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class TattooistAppointmentsAccessTest extends TestCase
{
    private Client $client;

    public function setup(): void
    {
        parent::setUp();
        $this->client = new Client([
            'allow_redirects' => false, // Disable following redirects
            'base_uri' => 'http://web:8080'
        ]);
    }

    public function test_should_not_access_the_index_route_if_not_authenticated(): void
    {
        $response = $this->client->get('tattooist/appointments');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_show_route_if_not_authenticated(): void
    {
        $response = $this->client->get('tattooist/appointments/1');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_route_route_if_not_authenticated(): void
    {
        $response = $this->client->get('tattooist/appointments/new');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_create_route_if_not_authenticated(): void
    {
        $response = $this->client->post('tattooist/appointments', []);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_edit_route_if_not_authenticated(): void
    {
        $response = $this->client->get('tattooist/appointments/1/edit');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }

    public function test_should_not_access_the_update_route_if_not_authenticated(): void
    {
        $response = $this->client->put('tattooist/appointments/1', []);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }
}
