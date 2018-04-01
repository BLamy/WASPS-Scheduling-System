<?php

use PHPUnit\Framework\TestCase;

class AdminUsersTest extends TestCase
{
    private $http;
    private $cookieJar;

    public function setUp()
    {
        $this->cookieJar = new \GuzzleHttp\Cookie\CookieJar();
        $this->http = new GuzzleHttp\Client(['base_uri' => 'localhost:8000', 'http_errors' => false]);
        $this->http->request('POST', '/tests/setupTestDB.php');
        $response = $this->http->request('POST', '/api/login.php', [
            'json' => [
                'email' => 'admin@websterwasps.com',
                'password' => 'admin',
            ],
            'cookies' => $this->cookieJar,
        ]);
    }

    public function tearDown()
    {
        $this->http->request('DELETE', '/api/logout.php', ['cookies' => $this->cookieJar]);
        $this->http = null;
    }

    public function testGetById()
    {
        $response = $this->http->request('GET', '/api/users.php?id=1', ['cookies' => $this->cookieJar]);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $data = json_decode($response->getBody(true), true);
        $this->assertEquals([
            'id' => 1,
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'role' => 'admin',
            'phone' => '5852167829',
            'email' => 'admin@websterwasps.com',
            'registered' => '2018-01-01 00:00:00',
        ], $data);
    }

    public function testGetByName()
    {
        $response = $this->http->request('GET', '/api/users.php?name=Su', ['cookies' => $this->cookieJar]);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $data = json_decode($response->getBody(true), true);
        $this->assertEquals([[
            'id' => 1,
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'role' => 'admin',
            'phone' => '5852167829',
            'email' => 'admin@websterwasps.com',
            'registered' => '2018-01-01 00:00:00',
        ]], $data);
    }

    public function testGetUsers()
    {
        $response = $this->http->request('GET', '/api/users.php', ['cookies' => $this->cookieJar]);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $data = json_decode($response->getBody(true), true);
        // TODO: Add more data to test database to test default limit of 10 per page
        // $this->assertEquals(10, count($data));
        $this->assertEquals([
            'id' => 1,
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'role' => 'admin',
            'phone' => '5852167829',
            'email' => 'admin@websterwasps.com',
            'registered' => '2018-01-01 00:00:00',
        ], $data[0]);
    }

    // TODO: Add more data to the database so we can test number_per_page
    // public function testGetUserNumberPerPage()
    // {
    //     $response = $this->http->request('GET', '/api/users.php?number_per_page=11');
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $contentType = $response->getHeaders()["Content-Type"][0];
    //     $this->assertEquals("application/json", $contentType);
    //     $data = json_decode($response->getBody(true), true);
    //     $this->assertEquals(11, count($data));
    // }

    // TODO: Admins should be able to create admins
    //  public function testCreateAdmin() {
    //      $response = $this->http->request('POST', '/api/users.php', [
    //          'json' => [
    //              'firstName' => 'Test',
    //              'lastName' => 'Admin',
    //              'role' => 'admin',
    //              'password' => 'password',
    //              'phone' => '2036259401',
    //              'email' => 'testAdmin@websterwasps.com'
    //          ],
    //          'cookies' => $this->cookieJar
    //      ]);
    //      $this->assertEquals(201, $response->getStatusCode());
    //      $contentType = $response->getHeaders()["Content-Type"][0];
    //      $this->assertEquals("application/json", $contentType);
    //      $passenger = json_decode($response->getBody(true), true);
    //      $this->assertEquals('Test', $passenger->firstName);
    //      $this->assertEquals('Admin', $passenger->lastName);
    //      $this->assertEquals('admin', $passenger->role);
    //      $this->assertEquals('admin', $passenger->role);
    //      $this->assertEquals('2036259401', $passenger->phone);
    //      $this->assertEquals('testAdmin@websterwasps.com', $passenger->email);
    //  }

    // TODO: Admins should be able to create dispatchers
    //  public function testCreateDispatcher() {
    //      $response = $this->http->request('POST', '/api/users.php', [
    //          'json' => [
    //              'firstName' => 'Test',
    //              'lastName' => 'Dispatcher',
    //              'password' => 'password',
    //              'role' => 'dispatcher',
    //              'phone' => '2034229403',
    //              'email' => 'testDispatcher@websterwasps.com'
    //          ],
    //          'cookies' => $this->cookieJar
    //      ]);
    //      $this->assertEquals(201, $response->getStatusCode());
    //      $contentType = $response->getHeaders()["Content-Type"][0];
    //      $this->assertEquals("application/json", $contentType);
    //      $passenger = json_decode($response->getBody(true), true);
    //      $this->assertEquals('Test', $passenger->firstName);
    //      $this->assertEquals('Dispatcher', $passenger->lastName);
    //      $this->assertEquals('dispatcher', $passenger->role);
    //      $this->assertEquals('2034229403', $passenger->phone);
    //      $this->assertEquals('testDispatcher@websterwasps.com', $passenger->email);
    //  }

    // TODO: Admins should be able to create Drivers
    // public function testCreateDriver() {
    //      $response = $this->http->request('POST', '/api/users.php', [
    //          'json' => [
    //              'firstName' => 'Test',
    //              'lastName' => 'Driver',
    //              'password' => 'password',
    //              'role' => 'driver',
    //              'phone' => '2034259401',
    //              'email' => 'testDriver@websterwasps.com'
    //          ],
    //          'cookies' => $this->cookieJar
    //      ]);
    //      $this->assertEquals(201, $response->getStatusCode());
    //      $contentType = $response->getHeaders()["Content-Type"][0];
    //      $this->assertEquals("application/json", $contentType);
    //      $passenger = json_decode($response->getBody(true), true);
    //      $this->assertEquals('Test', $passenger->firstName);
    //      $this->assertEquals('Driver', $passenger->lastName);
    //      $this->assertEquals('driver', $passenger->role);
    //      $this->assertEquals('2034259401', $passenger->phone);
    //      $this->assertEquals('testDriver@websterwasps.com', $passenger->email);
    //  }

    public function testCreatePassenger()
    {
        $response = $this->http->request('POST', '/api/users.php', [
            'json' => [
                'firstName' => 'Test',
                'lastName' => 'Driver',
                'password' => 'password',
                'phone' => '2034259401',
                'email' => 'testDriver@websterwasps.com',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(201, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $passenger = json_decode($response->getBody(true), true);
        $this->assertEquals('Test', $passenger['firstName']);
        $this->assertEquals('Driver', $passenger['lastName']);
        $this->assertEquals('passenger', $passenger['role']);
        $this->assertEquals('2034259401', $passenger['phone']);
        $this->assertEquals('testDriver@websterwasps.com', $passenger['email']);
    }

    public function testCreateRequiresFirstName()
    {
        $response = $this->http->request('POST', '/api/users.php', [
            'json' => [
                'lastName' => 'Driver',
                'password' => 'password',
                'phone' => '2038259401',
                'email' => 'testDriver@websterwasps.com',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testCreateRequiresLastName()
    {
        $response = $this->http->request('POST', '/api/users.php', [
            'json' => [
                'firstName' => 'Test',
                'password' => 'password',
                'phone' => '2034258401',
                'email' => 'testDriver@websterwasps.com',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testCreateRequiresPassword()
    {
        $response = $this->http->request('POST', '/api/users.php', [
            'json' => [
                'firstName' => 'Test',
                'lastName' => 'Driver',
                'phone' => '2034259481',
                'email' => 'testDriver@websterwasps.com',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testCreateRequiresPhone()
    {
        $response = $this->http->request('POST', '/api/users.php', [
            'json' => [
                'firstName' => 'Test',
                'lastName' => 'Driver',
                'password' => 'password',
                'email' => 'testDriver@websterwasps.com',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testCreateRequiresEmail()
    {
        $response = $this->http->request('POST', '/api/users.php', [
            'json' => [
                'firstName' => 'Test',
                'lastName' => 'Driver',
                'password' => 'password',
                'phone' => '2034259481',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testUpdateUser()
    {
        $response = $this->http->request('PUT', '/api/users.php?id=1', [
            'json' => [
                'firstName' => 'Main',
            ],
            'cookies' => $this->cookieJar,
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        $passenger = json_decode($response->getBody(true), true);
        $this->assertEquals(1, $passenger['id']);
        $this->assertEquals('Main', $passenger['firstName']);
    }

    public function testDeleteUser()
    {
        $response = $this->http->request('DELETE', '/api/users.php?id=7', ['cookies' => $this->cookieJar]);
        $this->assertEquals(200, $response->getStatusCode());
    }
    // can update own Password
    // can update others Password
}
