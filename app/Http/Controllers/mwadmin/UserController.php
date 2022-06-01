<?php
// only one controller used as all activities are related to users
namespace App\Http\Controllers\mwadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Ip_whitelisting;
use App\Models\Attendance;
use Carbon\Carbon;

use Mail;

use App\Mail\NotifyMail;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::orderBy('id','desc')
        ->get(['*']);

        return view('admin/user/users' ,compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/add' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|min:5|unique:users,user_name,'.$request->user_name,
            'full_name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$request->email,
        ]);
        $pass  = $this->generateRandomString();
        $this->send_password($pass,$request->email);
        $validatedData['password'] = md5($pass);
        User::create($validatedData);
        return back()->with('success', 'User created successfully. username : '.$request->user_name. ' and password : '.$pass);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user_data'] =  User::select('*')
        ->where('id', $id)
        ->first();

        return view('admin/user/edit' ,compact('data'));
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|min:5|unique:users,id,'.$request->input('user_id'),
            'full_name' => 'required|min:5',
            // 'email' => 'required|email|unique:users,email,'.$request->email,
            'email'  =>  'required|unique:users,id,'.$request->input('user_id')

        ]);

        $student = User::find($request->input('user_id'));
        $student->user_name = $request->input('user_name');
        $student->email = $request->input('email');
        $student->full_name = $request->input('full_name');

        $student->update();
        return redirect()->back()->with('success','User Updated Successfully');
        return view('admin/user/edit' ,compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $user = User::find($_POST['user_id']);
        // echo "<pre>";print_r($flight);
        $user->delete();


        return redirect("user")->with('success','User deleted');;
    }

    ///////////////////////// user attendance //////////////////////////

    public function attendance(Request $request)
    {
        $user_id = $request->session()->get('attendance_session.user_id');

        $dt_arr = Carbon::now()->toArray();
        $current_date = $dt_arr['year'].'-'.$dt_arr['month'].'-'.$dt_arr['day'];
        $data['attendance'] =  Attendance::select('*')
        ->where('user_id', $user_id)
        ->whereDate('date', '=', $current_date)
        ->count();

        return view('admin/user/attendance',compact('data') );
    }

    public function attendance_store(Request $request)
    {
        $user_id = $request->session()->get('attendance_session.user_id');
        $data1['user_id'] = $user_id;
        $dt_arr = Carbon::now()->toArray();
        $data1['date'] = $dt_arr['year'].'-'.$dt_arr['month'].'-'.$dt_arr['day'];
        // echo "<pre>";print_r($data);exit;
        Attendance::create($data1);

        return redirect("attendance");
    }

    public function user_attendance($id)
    {
        $user_data = Attendance::orderBy('id','desc')->join('users', 'users.id', '=', 'attendance.user_id')
        ->where('user_id', $id)
                ->get(['attendance.*', 'users.full_name']);
        //         $user_data = Attendance::with('user')->orderBy('id','desc')
        // ->where('user_id', $id)
        //         ->get('*');
        // echo "<pre>";dd($user_data->user);exit;
        return view('admin/user/user_attendance_list' ,compact('user_data'));
    }

    /// ip access ///
    public function ip_access($id)
    {
        $data['ips'] =  Ip_whitelisting::select('*')
        ->where('user_id', $id)
        ->get();
        // $data['ips'] = $comments = User::find(1)->ips()->where('user_id', $id);
        // $data['ips'] = User::find(1)->ips()
        //             ->where('user_id', $id)
        //             ->first();
        // echo "<pre>";print_r($data);exit;
        $data['user_id'] = $id;
        return view('admin/user/ip_whitelist' ,compact('data'));
    }

    public function add_ip_access(Request $request)
    {
        $data1['user_id'] = $_POST['user_id'];
        $data1['ip'] = $_POST['ip'];
        // $dt_arr = Carbon::now();

        // echo "<pre>";print_r($data1);exit;
        Ip_whitelisting::create($data1);

        return redirect("ip_access/".$_POST['user_id']);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // couldnt fild proper email service
    public function send_password($password,$email)
    {
        return false;
      Mail::to($email)->send(new NotifyMail($password));

      if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }
    }
}
