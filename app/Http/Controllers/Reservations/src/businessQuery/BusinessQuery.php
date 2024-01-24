<?php
namespace App\Http\Controllers\Reservations\src\businessQuery;

use Illuminate\Support\Facades\DB;
use App\src\traits\BaseController;

class BusinessQuery extends BaseController
{
    private function fieldRow()
    {
        return DB::raw('tb1.ID, tb3.NAME, tb1.ID_MEMBER, tb2.TABLENUMBER, tb2.DESC');
    }
    private function fieldKeyId()
    {
        return 'ID';
    }
    private function fieldKeyCheck()
    {
        return 'ID';
    }
    private function tableSetReservation()
    {
        return 'tb_reservation';
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
    public function querySelectAll($fieldText, $valueText)
    {
        return DB::table($this->tableSetReservation() . ' as tb1')
            ->join($this->tableSetTableExis() . ' as tb2', 'tb1.TABLENUMBER', '=', 'tb2.TABLENUMBER')
            ->join($this->tableSetMember() . ' as tb3', 'tb1.ID_MEMBER', '=', 'tb3.ID_MEMBER')
            ->select($this->fieldRow())
            ->where($fieldText, 'like', '%' . $valueText . '%');
    }
    public function queryInsert($req)
    {
        return DB::table($this->tableSetReservation())->insert($req);
    }
    public function queryUpdateUsedTableReservation($id)
    {
        $status = ['STATUS' => 1];
        return DB::table($this->tableSetTableExis())->where('TABLENUMBER', $id)->update($status);
    }
    public function queryUpdateUnUsedTableReservation($id)
    {
        $status = ['STATUS' => 0];
        return DB::table($this->tableSetTableExis())->where('TABLENUMBER', $id)->update($status);
    }
    public function queryReportReservation($req)
    {
        return DB::table($this->tableSetReportReservation())->insert($req);
    }
    public function queryUpdate($req, $id)
    {
        return DB::table($this->tableSetReservation())->where($this->fieldKeyId(), $id)->update($req);
    }
    public function queryDelete($id)
    {
        return DB::table($this->tableSetReservation())->where($this->fieldKeyId(), '=', $id)->delete();
    }
    public function dataNotFoundById($id)
    {
        if ($this->checkKey($this->fieldKeyCheck(), $id) == false) {
            $res = 'not found';
        }
        return $res;
    }
    public function checkKey($fieldText = '', $id)
    {
        $data = $this->querySelectAll($fieldText, $id)->get();
        $res = $data;
        (collect($data)->isEmpty()) ? $res = false : $res = true;
        return $res;
    }
    public function checkTableUsed($id)
    {
        $data = DB::table($this->tableSetTableExis())
            ->where('TABLENUMBER', $id)
            ->where('STATUS', 1)
            ->get();
        $res = $data;
        (collect($data)->isEmpty()) ? $res = false : $res = true;
        return $res;
    }





}