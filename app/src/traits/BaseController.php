<?php
namespace App\src\traits;

use App\src\traits\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function HandlerErrorFieldText($ex, $data)
    {
        $handler = app(\App\Exceptions\HandlerException::class);
        return $handler->exceptionErrorFieldText($ex, $data);
    }
    public function HandlerQueryExceptionsInsert($ex)
    {
        $handler = app(\App\Exceptions\HandlerException::class);
        return $handler->HandlerQueryExceptionsEntry($ex);
    }

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];
        return response()->json($response, 200);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function responseDataAll($total, $data)
    {
        $dataRecord = array(
            "RecordsTotal" => $total,
            "RecordsFiltered" => $total,
            "Data" => $data,
        );
        return $this->sendResponse($dataRecord, 'all data existing');
    }
    public function countData()
    {
        return $this->querySelectAll()->count();
    }
    public function fieldSelect($request, $fieldText, $valueText)
    {
        $data = [
            "fieldText" => '',
            "valueText" => '',
        ];
        if (collect($valueText)->isNotEmpty()) {
            $data = [
                "fieldText" => $request->get($fieldText),
                "valueText" => $request->get($valueText),
            ];
        }
        return $data;
    }

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

}
