<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
  /**
   * A list of exception types with their corresponding custom log levels.
   *
   * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
   */
  protected $levels = [
    //
  ];

  /**
   * A list of the exception types that are not reported.
   *
   * @var array<int, class-string<\Throwable>>
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed to the session on validation exceptions.
   *
   * @var array<int, string>
   */
  protected $dontFlash = [
    'current_password',
    'password',
    'password_confirmation',
  ];

  // https://stackoverflow.com/a/51065582/7450617
  public function render($request, Throwable $exception)
  {
    if ($request->wantsJson()) {
      return $this->handleApiException($request, $exception);
    }

    return parent::render($request, $exception);
  }

  private function handleApiException($request, Throwable $exception)
  {
    $exception = $this->prepareException($exception);

    if ($exception instanceof NotFoundHttpException) {
      return response()->json(['message' => 'Not Found'], 404);
    }


    return parent::render($request, $exception);
    // return $this->customApiResponse($exception);
  }

  /**
   * Register the exception handling callbacks for the application.
   *
   * @return void
   */
  public function register()
  {
    $this->reportable(function (Throwable $e) {
      //
    });
  }
}
