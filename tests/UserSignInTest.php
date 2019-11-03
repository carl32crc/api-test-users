<?php
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


class UserSignInTest extends TestCase 
{
    protected function setUp() :void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8888/api/'
        ]);
    }

    public function testSignInWithCorrectPassword() {
        $res = $this->client->request('POST', 'authenticate', [
            'json' => [
                'email' => 'psyduck@gmail.com',
                'password' => '123d/fAes4'
            ]
        ]);

        $this->assertTrue($res->getStatusCode() === 200);

        $body = json_decode($res->getBody())->user->firstName;

        $this->assertNotEmpty($body);
    }

    public function testSignInWithIncorrectPassword() {
        $res = $this->client->request('POST', 'authenticate', [
            'json' => [
                'email' => 'psyduck@gmail.com',
                'password' => '1d/fAes4'
            ]
        ]);

        $this->assertTrue($res->getStatusCode() === 200);

        $body = json_decode($res->getBody())->message;

        $this->assertEquals('Email or password incorrect.', $body);
    }
}