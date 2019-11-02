<?php
namespace App\Middlewares;

use Slim\Psr7\Response;
use App\Shared\ValidatorString;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class PasswordValidator
{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);

        $user = (object) $request->getParsedBody();

        if (empty($user->password)) {
            $response = new Response();
            $message = array('message' => 'Password is empty.');
            $response->getBody()->write(json_encode($message));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        $validatorString = new ValidatorString();
        $numberOfChars = 8;

        $validators = [
            $validatorString->containNumber($user->password),
            $validatorString->containLowercase($user->password),
            $validatorString->containUppercase($user->password),
            $validatorString->containNumberOfCharsOrMore($user->password, $numberOfChars),
            $validatorString->containSymbol($user->password),
        ];

        if (in_array(false, $validators)) {
            $response = new Response();
            $message = array('message' => 'Password must contain at least one lowercase, uppercase, symbol, number and ' . $numberOfChars . ' chars.');
            $response->getBody()->write(json_encode($message));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        return $response;
    }
}
