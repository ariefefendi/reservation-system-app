<?php

namespace App\Http\Controllers\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Reservations\src\businessQuery\BusinessQuery;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReservationsController extends BusinessQuery
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
            // handler field error.
            $data = $this->HandlerErrorFieldText($ex, $data);
            return $this->sendError($data['message'], $data['data']);
        }
    }

    // done insert
    public function Insert(Request $request)
    {
        $req = [
            'ID_MEMBER' => $request->input('ID_MEMBER'),
            'TABLENUMBER' => $request->input('TABLENUMBER'),
            'created_at' => Carbon::now()->isoFormat('YYYY-MM-DD hh:mm:ss') // 2024-01-24 01:48:54
        ];

        try {
            // check table ready.
            $check = $this->checkTableUsed($req['TABLENUMBER']);
            if ($check == true) {
                $msg = "Number is ordered.";
                $res = $this->sendError($msg);
            } else {
                // $msg = "Number is ready.";
                $data = $this->queryInsert($req);
                $this->queryUpdateUsedTableReservation($req['TABLENUMBER']);
                $res = $this->sendResponse($data, 'successfully!');
            }
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

    // done destroy order.
    public function destroyOrder(Request $request)
    {
        $id = $request->get('id');
        $req = $this->checkKey($fieldText = 'ID', $id);
        if ($req == true) {
            // get data reservation exis
            $data = $this->querySelectAll('ID', $id)->get();
            foreach ($data as $v) {
                $req = [
                    "ID_MEMBER" => $v->ID_MEMBER,
                    "TABLENUMBER" => $v->TABLENUMBER,
                    "created_at" => Carbon::now()->isoFormat('YYYY-MM-DD hh:mm:ss')
                ];
            }
            // move to report reservation.
            $this->queryReportReservation($req);
            // status tables exis.
            $r = $this->queryUpdateUnUsedTableReservation($req['TABLENUMBER']);

            // delete data reservation
            $this->queryDelete($id);
            $res = $this->dataNotFoundById($id);
            $res = $this->sendResponse($res, 'Customer has left!');
        } else {
            $res = $this->sendError('no order!');
        }
        return $res;
    }
}
