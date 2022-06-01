<?php

namespace App\Http\Controllers\mwadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Access;
use App\Models\AccessModule;
use App\Models\Categorymst as Category;
use App\Models\User;
use App\Models\Company_user;
use App\Models\Ip_whitelisting;
use DB;

//use DataTables;

class Admin extends Controller
{
    public function __construct()
    {
        $this->acces_super=true;
        $this->mw_session = session('attendance_session');


    }

    // both user and comany has same url for login
    public function index(Request $request)
    {
        $request->session()->flush();
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required|min:5',
        ], [
            'username.required' => 'Username field is required.',
            'password.required' => 'Password field is required.',
        ]);

        //temperoririly MD5 used for encryption
        if($request->input('employee_type') == 'company')
        {
            $row = Company_user::select('*')
            ->where('user_name', $request->input('username'))
            ->where('password', md5($request->input('password')))
            ->first();
        }
        else
        {
            $row = User::select('*')
            ->where('user_name', $request->input('username'))
            ->where('password', md5($request->input('password')))
            ->first();
        }

        if(isset($row->password))
        {
            if($request->input('employee_type') == 'user')
            {
                $ip = $_SERVER['REMOTE_ADDR'];
                // $ip = '127.0.0.11';
                $row1 = Ip_whitelisting::select('*')
                    ->where('user_id', $row->id)
                        ->where('ip', $ip)
                ->first();

                if(!isset($row1->ip))
                {
                    return redirect("mwadmin")->with('error','Your Ip is not whitelisted!');exit;
                }
            }

            $request->session()->put('attendance_session.user_name',$row->user_name);
            $request->session()->put('attendance_session.user_id',$row->id);
            $request->session()->put('attendance_session.user_type',$request->input('employee_type'));

            if($request->input('employee_type') == 'company')
            {
                return redirect("user");
            }
            else
            {
                return redirect("attendance");
            }
        }
        else
        {
            return redirect("mwadmin")->with('error','Invalid Username or Password!');;
        }
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("mwadmin");
    }

}
