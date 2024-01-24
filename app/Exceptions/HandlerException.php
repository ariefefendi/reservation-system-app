<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class HandlerException extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    public function exceptionErrorFieldText($ex, $data)
    {
        $errorCode = $ex->errorInfo[1]; // code = 1054
        if ($errorCode == 1054) {
            $data = [
                'message' => 'fieldText not found!',
                'data' => $data->wheres
            ];
        }
        return $data;
    }

    public function HandlerQueryExceptionsEntry($errorCode)
    {
        if ($errorCode == 1366) {
            $data = [
                'message' => 'only number allowed!',
                'data' => $errorCode
            ];
        }
        if ($errorCode == 1062) {
            $data = [
                'message' => 'Duplcate data!',
                'data' => $errorCode
            ];
        }
        if ($errorCode == 1452) {
            $data = [
                'message' => 'Foreign Key wrong!',
                'data' => $errorCode
            ];
        }
        return $data;
    }


}
