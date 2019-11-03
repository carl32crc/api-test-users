<?php
namespace App\Controllers;

use App\Services\SignInService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SignInController
{

    public function __construct()
    {
        $this->signInService = new SignInService();
    }

    public function authenticate(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();

        $result = $this->signInService->authenticate($body['email'], $body['password']);

        if ($result) {
            $response->getBody()->write(json_encode($result));

            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        $message = array('message' => 'Email or password incorrect.');
        $response->getBody()->write(json_encode($message));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);

    }
}
