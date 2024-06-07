<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager');
    }


}
