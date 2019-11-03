<?php
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


class UserCreateTest extends TestCase 
{
    protected function setUp() :void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8888/api/'
        ]);
    }

    public function testCreateUserWithCorrectParams() {
        $res = $this->client->request('POST', 'users', [
            'json' => [
                'email' => 'psyduck@gmail.com',
                'password' => '123d/fAes4',
                'firstName' => 'Psy',
                'lastName' => 'Duck'
            ]
        ]);
        
        if($res->getStatusCode() === 201) {
            $this->assertTrue($res->getStatusCode() === 201);
        } else {
            $this->assertTrue($res->getStatusCode() === 200);
        }
    }

    public function testCreateUserWithIncorrectEmail() {
        $res = $this->client->request('POST', 'users', [
            'json' => [
                'email' => 'psyduck',
                'password' => '123d/fAes4',
                'firstName' => 'Psy',
                'lastName' => 'Duck'
            ]
        ]);

        $this->assertTrue($res->getStatusCode() === 200);

        $message = json_decode($res->getBody())->message;

        $this->assertEquals('Invalid email', $message);
    }

    public function testCreateUserWithIncorrectPassword() {
        $res = $this->client->request('POST', 'users', [
            'json' => [
                'email' => 'psyduck333@gmail.com',
                'password' => '123dfAes4',
                'firstName' => 'Psy',
                'lastName' => 'Duck'
            ]
        ]);

        $this->assertTrue($res->getStatusCode() === 200);

        $message = json_decode($res->getBody())->message;

        $this->assertEquals('Password must contain at least one lowercase, uppercase, symbol, number and 8 chars.', $message);
    }

    public function testCreateUserWithEmailTaken() {
        $res = $this->client->request('POST', 'users', [
            'json' => [
                'email' => 'psyduck@gmail.com',
                'password' => '123d/fAes4',
                'firstName' => 'Psy',
                'lastName' => 'Duck'
            ]
        ]);

        $this->assertTrue($res->getStatusCode() === 200);

        $message = json_decode($res->getBody())->message;

        $this->assertEquals('This user is already registered.', $message);
    }
}
