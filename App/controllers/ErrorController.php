<?php

namespace App\Controllers;

class ErrorController
{
  /*
   * route 404 not found error
   *
   * @return void
   */
  public static function notFound($message = 'Route not found')
  {
    http_response_code(404);

    loadView('error', [
      'status' => '404',
      'message' => $message
    ]);
  }
}