<?php
namespace App\Http\Controllers\ReportReservations;

use Illuminate\Http\Request;
use App\Http\Controllers\ReportReservations\src\businessQuery\BusinessQuery;

class ReportReservationsController extends BusinessQuery
{
    // Get Data All && // Get Select data by ..
    public function getDataSelectAll(Request $request)
    {
        try {
            $data = $this->querySelectAll();
            $data = $data->get();
            $total = $data->count();
            return $this->responseDataAll($total, $data);
        } catch (\Illuminate\Database\QueryException $ex) {
            // handler field error.
            $data = $this->HandlerErrorFieldText($ex, $data);
            return $this->sendError($data['message'], $data['data']);
        }
    }

}
