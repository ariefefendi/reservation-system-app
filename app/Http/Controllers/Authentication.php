<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\src\traits\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Authentication extends BaseController
{

    private $tablemember;
    private $tablepassmember;
    private $paramcekidsftaf;
    private $paramcekemail;
    private $paramcekepass;
    function __construct()
    {
        $this->tablemember = "tb_member";
        $this->tablepassmember = "tb_pass_member";
        $this->paramcekidsftaf = "ID_MEMBER";
        $this->paramcekemail = "EMAIL";
        $this->paramcekepass = "PASS";
    }

    static function GenerateID($lengthChar)
    {
        $characters = '0123456789';
        $accountNumber = '';

        for ($i = 0; $i < $lengthChar; $i++) {
            $accountNumber .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $accountNumber;
    }

    function register(Request $request)
    {
        $input = $request->only('EMAIL', 'NAME', 'PASS', 'USERNAME');
        $validator = Validator::make($input, [
            'NAME' => 'required',
            'USERNAME' => 'required',
            'EMAIL' => 'required|email|unique:users',
            'PASS' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        // insert user
        $pass = bcrypt($input['PASS']); // use bcrypt to hash the passwords
        $dataUser = [
            'name' => $input['NAME'],
            'email' => $input['EMAIL'],
            'password' => $pass,
        ];
        $user = User::create($dataUser); // eloquent creation of data
        $success['user'] = $user;
        // create member
        $datamember = [
            'NAME' => $input['NAME'],
            'EMAIL' => $input['EMAIL'],
            'USERNAME' => $input['USERNAME']
        ];
        $ressatf = DB::table($this->tablemember)->insert($datamember);
        $success['member'] = $ressatf;
        // create member pass
        $sqlgetidmember = DB::table($this->tablemember)
            ->select(DB::raw($this->tablemember . "." . $this->paramcekidsftaf))
            ->where($this->tablemember . "." . $this->paramcekemail, '=', $input['EMAIL']);
        $getidmember = $sqlgetidmember->first();
        $idmember = $getidmember->ID_MEMBER;
        $idpassmember = $this->GenerateID('5');
        $passmember = sha1($input['PASS']);
        $datapassmember = [
            'ID_PASS_MEMBER' => $idpassmember,
            'ID_MEMBER' => $idmember,
            'PASS' => $passmember,
        ];
        $respass = DB::table($this->tablepassmember)->insert($datapassmember);
        $success['pass'] = $respass;

        return $this->sendResponse($success, 'User register successfully.');
    }

    function CekIdMemberOrMail($username)
    {
        if (strpos($username, '@') !== false) {
            $cekparam = "email";
        } else {
            if (!preg_match('/[^0-9]/', $username)) // '/[^a-z\d]/i' should also work.
            {
                $cekparam = "idmember";
            } else {
                $cekparam = "usernmae";
            }
        }
        return $cekparam;
    }

    function GetCountTryLoginmember($idmember)
    {
        $sqlcek = DB::table($this->tablepassmember)
            ->select(DB::raw($this->tablepassmember . ".TRY_COUNT," . $this->tablepassmember . ".ID_PASS_MEMBER"))
            ->where($this->tablepassmember . "." . $this->paramcekidsftaf, '=', $idmember);
        return $sqlcek->first();
    }

    function login(Request $request)
    {
        $input = $request->only('username', 'password');

        $validator = Validator::make($input, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $cekparam = $this->CekIdMemberOrMail($input['username']);

        if ($cekparam === "email") {
            $sqlgetidmember = DB::table($this->tablemember)
                ->select(DB::raw($this->tablemember . "." . $this->paramcekidsftaf))
                ->where($this->tablemember . "." . $this->paramcekemail, '=', $input['username']);
            $getidmember = $sqlgetidmember->first();
            $countcek = $sqlgetidmember->count();
            if ($countcek > 0) {
                $email = $input['username'];
                $idmember = $getidmember->ID_MEMBER;
            } else {
                return $this->sendResponse("402", 'Username wrong!');
            }
        } else {
            $sqlcekmail = DB::table($this->tablemember)
                ->select(DB::raw($this->tablemember . "." . $this->paramcekemail))
                ->where($this->tablemember . "." . $this->paramcekidsftaf, '=', $input['username']);
            $paramcekmail = $sqlcekmail->first();
            $countcek = $sqlcekmail->count();
            if ($countcek > 0) {
                $email = $paramcekmail->EMAIL;
                $idmember = $input['username'];
            } else {
                return $this->sendResponse("402", 'Username wrong!');
            }
        }

        $CekCountTry = $this->GetCountTryLoginmember($idmember);
        if ($CekCountTry->TRY_COUNT == '3') {
            return $this->sendResponse("405", 'Account Has Been Blocked.');
        } else {
            $sqlcekemail = DB::table($this->tablemember)
                ->select(DB::raw($this->tablemember . "." . $this->paramcekemail))
                ->where($this->tablemember . "." . $this->paramcekemail, '=', $email);
            $cekmail = $sqlcekemail->count();
            $sqlcekpass = DB::table($this->tablepassmember)
                ->select(DB::raw($this->tablepassmember . "." . $this->paramcekepass))
                ->where($this->tablepassmember . "." . $this->paramcekepass, '=', sha1($input['password']));
            $cekpass = $sqlcekpass->count();

            if ($cekmail < 1) {
                return $this->sendResponse("402", 'Username worng!');
            } elseif ($cekpass < 1) {
                $DataUpdateCount = [
                    "TRY_COUNT" => $CekCountTry->TRY_COUNT + 1,
                ];
                DB::table($this->tablepassmember)->where("ID_PASS_MEMBER", $CekCountTry->ID_PASS_MEMBER)->update($DataUpdateCount);
                return $this->sendResponse("403", 'Password worng!');
            } else {
                if (Auth::attempt(['email' => $email, 'password' => $input['password']])) {
                    $user = Auth::user();
                    $success['token'] = $user->createToken('MyApp')->plainTextToken;
                    $success['name'] = $user->name;

                    return $this->sendResponse($success, 'User login successfully.');
                } else {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                }
            }
        }
    }
}
