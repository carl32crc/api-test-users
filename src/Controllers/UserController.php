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
        $query = $request->getQueryParams();
        $page = $query['page'] ?? false;
        $take = $query['take'] ?? false;
        if($query && $page && $take) {
            $result = $this->userService->getAll($query['page'], $query['take']);

            $response->getBody()->write(json_encode($result));

            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        $message = array('message' => 'Incorrect query params, needed page and take params for works.');
        $response->getBody()->write(json_encode($message));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
        
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
        $user = (object) $request->getParsedBody();

        $foundUserInSystem = $this->userService->getByEmail($user->email);

        if($foundUserInSystem) {
            $message = array('message' => 'This user is already registered.');
            $response->getBody()->write(json_encode($message));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200); 
        }

        $result = $this->userService->create($user);

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
