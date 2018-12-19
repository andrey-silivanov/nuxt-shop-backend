<?php
declare (strict_types=1);

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\{
    TokenExpiredException,
    TokenInvalidException
};
use App\Http\Controllers\Traits\JsonResponseTrait,
    Exception,
    Illuminate\Auth\AuthenticationException,
    Illuminate\Foundation\Exceptions\Handler as ExceptionHandler,
    Illuminate\Validation\ValidationException,
    Illuminate\Database\Eloquent\ModelNotFoundException,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    use JsonResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenExpiredException) {
            return response()->json(['token_expired'], $exception->getStatusCode());
        } else if ($exception instanceof TokenInvalidException) {
            return response()->json(['token_invalid'], $exception->getStatusCode());
        } else if ($exception instanceof ValidationException) {

            return $this->invalidResponse($exception->errors());
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->notFoundResponse('Requested url is invalid');
        }

        if ($exception instanceof ModelNotFoundException)
            return $this->notFoundResponse($exception->getMessage());


        if ($exception instanceof \Swift_TransportException)
            return $this->internalErrorResponse('Error email service');

        return parent::render($request, $exception);
    }
}
