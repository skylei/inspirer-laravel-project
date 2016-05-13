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
                return api_success();
            } else {
                return redirect()->route('inspirer-blog.admin.home'); 
            }
        }
        
        if ($request->ajax()) {
            return api_fail('200001');
        } else {
            return back()->withErrors(response_message('200001'));
        }
    }

    public function gate()
    {
        return view('inspirer-blog.admin.gate');
    }
}
