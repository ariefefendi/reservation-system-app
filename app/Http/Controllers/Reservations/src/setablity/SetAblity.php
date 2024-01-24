<?php
namespace App\Http\Controllers\TableNumber\src\setablity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\src\traits\BaseController;

class SetAblity extends BaseController
{
    public function fieldRow()
    {
        return DB::raw('TABLENUMBER');
    }

    public function tableSet()
    {
        $table = 'tb_table_exis';
    }
    public function sql()
    {
        return DB::table($this->tableSet())->select($this->fieldRow());
    }




}