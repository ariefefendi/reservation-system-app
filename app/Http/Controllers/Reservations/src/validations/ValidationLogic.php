<?php
namespace App\Http\Controllers\TableNumber\src\validations;

use Illuminate\Support\Facades\Validator;
use App\src\traits\BaseController;

class ValidationLogic extends BaseController
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    public function validationFailsValue($req)
    {
        $validated = Validator::make($req, [
            'TABLENUMBER' => 'required|numeric|unique:posts|max:3',
            'DESC' => 'required|max:9'
        ]);
        return $validated;
    }
    public function validationFailsduplicate($req)
    {
        $validated = Validator::make($req, [
            'TABLENUMBER' => 'required|numeric|unique:posts|max:3',
            'DESC' => 'required|max:9'
        ]);
        return $validated;
    }


}
