<?php
namespace App\Controllers;

use App\Services\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getAll(Request $request, Response $response, array $args)
    {

        $result = $this->userService->getAll();

        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function get(Request $request, Response $response, array $args)
    {

        $result = $this->userService->get($args['id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function create(Request $request, Response $response, array $args)
    {
        $result = $this->userService->create(
            (object) $request->getParsedBody()
        );

        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    public function update(Request $request, Response $response, array $args)
    {

        $this->userService->updateBasicData(
            $args['id'],
            (object) $request->getParsedBody()
        );

        return $response->withStatus(204);
    }

    public function delete(Request $request, Response $response, array $args)
    {
        $this->userService->delete($args['id']);

        return $response->withStatus(204);
    }
}
