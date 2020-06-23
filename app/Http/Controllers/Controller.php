<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setResponse($data = [],$status = 200, $message = ''){
        $d['data'] = $data;
        $d['status'] = $status;
        $d['message'] = $message;
        return response()->json($d,$status);
    }
}
