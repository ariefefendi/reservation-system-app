<?php
namespace App\Http\Controllers\ReportReservations\src\businessQuery;

use Illuminate\Support\Facades\DB;
use App\src\traits\BaseController;

class BusinessQuery extends BaseController
{
    private function fieldRow()
    {
        return DB::raw('tb3.NAME, tb1.ID_MEMBER, tb2.TABLENUMBER, tb2.DESC');
    }
    private function fieldKeyId()
    {
        return 'ID';
    }
    private function fieldKeyCheck()
    {
        return 'ID';
    }
    private function tableSetTableExis()
    {
        return 'tb_table_exis';
    }
    private function tableSetMember()
    {
        return 'tb_member';
    }
    private function tableSetReportReservation()
    {
        return 'report_reservation';
    }
    public function querySelectAll()
    {
        return DB::table($this->tableSetReportReservation() . ' as tb1')
            ->join($this->tableSetTableExis() . ' as tb2', 'tb1.TABLENUMBER', '=', 'tb2.TABLENUMBER')
            ->join($this->tableSetMember() . ' as tb3', 'tb1.ID_MEMBER', '=', 'tb3.ID_MEMBER')
            ->select($this->fieldRow());
    }
}