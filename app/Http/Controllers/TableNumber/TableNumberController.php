<?php
namespace App\Http\Controllers\TableNumber;

use Illuminate\Http\Request;
use App\Http\Controllers\TableNumber\src\businessQuery\BusinessQuery;

class TableNumberController extends BusinessQuery
{
    // Get Data All && // Get Select data by ..
    public function getDataSelectAll(Request $request)
    {
        try {
            $paramSelect = $this->fieldSelect($request, 'fieldText', 'valueText');
            $data = $this->querySelectAll($paramSelect['fieldText'], $paramSelect['valueText']);
            $data = $data->get();
            $total = $data->count();
            return $this->responseDataAll($total, $data);
        } catch (\Illuminate\Database\QueryException $ex) {
            // $Handler = app(\App\Exceptions\HandlerException::class);
            $data = $this->HandlerErrorFieldText($ex, $data);
            return $this->sendError($data['message'], $data['data']);
        }
    }

    // done
    public function Insert(Request $request)
    {
        $req = [
            'TABLENUMBER' => $request->input('TABLENUMBER'),
            'STATUS' => 0,
            'DESC' => $request->input('DESC')
        ];

        try {
            $data = $this->queryInsert($req);
            $res = $this->sendResponse($data, 'successfully!');
        } catch (\Illuminate\Database\QueryException $ex) {
            // get error code query.
            $errorCode = $ex->errorInfo[1]; // code error.
            // response handler error
            $data = $this->HandlerQueryExceptionsInsert($errorCode);
            // response data.
            $res = $this->sendError($data['message'], $data['data']);
        }
        return $res;

    }
    public function Update(Request $request)
    {
        $id = $request->input('ID');
        $req = [
            'STATUS' => 1,
            'DESC' => $request->input('DESC')
        ];

        try {
            $this->queryUpdate($req, $id);
            $res = $this->sendResponse($req, 'successfully!');
        } catch (\Illuminate\Database\QueryException $ex) {
            // get error code query.
            $errorCode = $ex->errorInfo[1]; // code error.
            // response handler error
            $data = $this->HandlerQueryExceptionsInsert($errorCode);
            // response data.
            $res = $this->sendError($data['message'], $data['data']);
        }
        return $res;

    }

    // check data by key and value search.
    public function CheckField(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        $checkid = $this->checkKey($key, $value);
        // check field id
        if ($checkid == false) {
            $res = $this->sendError($checkid, "not Found!");
        } else {
            $res = $this->sendResponse($checkid, 'Ok');
        }
        return $res;
    }

    // done
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $this->queryDelete($id);
        $res = $this->dataNotFoundById($id);
        return $this->sendResponse($res, 'delete success.');
    }
}
