<?php
namespace App\Http\Controllers\TableNumber\src\businessQuery;

use Illuminate\Support\Facades\DB;
use App\src\traits\BaseController;

class BusinessQuery extends BaseController
{
    public function fieldRow()
    {
        return DB::raw('TABLENUMBER, STATUS, `DESC`');
    }
    public function fieldKeyId()
    {
        return 'TABLENUMBER';
    }
    public function tableSet()
    {
        return 'tb_table_exis';
    }
    public function querySelectAll($fieldText, $valueText)
    {
        return DB::table($this->tableSet())->select($this->fieldRow())->where($fieldText, 'like', '%' . $valueText . '%');
    }
    public function queryInsert($req)
    {
        return DB::table($this->tableSet())->insert($req);
    }
    public function queryUpdate($req, $id)
    {
        return DB::table($this->tableSet())->where($this->fieldKeyId(), $id)->update($req);
    }
    public function queryDelete($id)
    {
        return DB::table($this->tableSet())->where($this->fieldKeyId(), '=', $id)->delete();
    }
    public function dataNotFoundById($id)
    {
        if ($this->checkKey('TABLENUMBER', $id) == false) {
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




}