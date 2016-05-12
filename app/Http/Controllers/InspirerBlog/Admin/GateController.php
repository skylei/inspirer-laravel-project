<?php

namespace App\Http\Controllers\InspirerBlog\Admin;

use App\Components\Inspirer\Http\Request;
use Auth;
use App\Http\Requests;
use App\Components\Inspirer\Controller;

class GateController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt($request->only(['name', 'password']), $request->input('remember', false))) {
            if ($request->ajax()) {
                
            } else {
                
            }
        }
    }
}
