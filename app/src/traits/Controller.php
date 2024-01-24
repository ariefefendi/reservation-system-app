<?php

namespace App\src\traits;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as mainController;

class Controller extends mainController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
