<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class CorrectEmail
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);

        $user = (object) $request->getParsedBody();

        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $response = new Response();
            $message = array('message' => 'Invalid email');
            $response->getBody()->write(json_encode($message));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        return $response;
    }
}
