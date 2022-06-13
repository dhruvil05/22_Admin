<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewRegister()
    {
        return view('admin.Register.register');
    }

    public function getData()
    {
        // $today = Carbon::today()->format('Y-m-d H:i:s');
        $all = DB::table('admins')->get();
        foreach ($all as $item) {
            $email = $item->email;
            $date = get_formatted_date($item->created_at, "d-m-Y");
            $currentDate = date('d-m-Y');
            if ($date == $currentDate) {

                echo "<pre>";
                print_r($date);
                echo "<pre>";
                print_r($email);
            }
            // print_r($currentDate);


        }

        // $user = DB::table('admins')->where('created_at', $today)->get();
    }

    public function viewLogin()
    {
        return view('admin.Register.login');
    }

    public function login(Request $request)
    {

        // echo "<pre>";
        // print_r($request->all());

        $request->validate([

            'email' => 'required|email',
            'password' => "required",


        ]);
        $email = $request->email;
        $password = $request->password;

        if ($request->remember_me == 1) {
            $cookie =  Cookie::queue('email', $email, time() + 31536000);
        } else {
            $cookie =  Cookie::queue('email', '', time() - 100);
        }
        if (DB::table('admins')->where('email', $email)->where('password', $password)->first()) {

            $user = DB::table('admins')->where('email', $email)->where('password', $password)->first();
            $id = $user->id;
            $email = $user->email;
            $image = $user->image;

            // $password = $user->$password;

            $request->session()->put('email', $email);
            $request->session()->put('id', $id);
            $request->session()->put('image', $image);

            // $request->session()->put('password', $password);
            // $session = session()->all();
            // print_r($session);

            return redirect('admin/dashboard')->with('status', " $email login Successfully");
        } else {
            return redirect('admin/login')->with('failed', " login failed try again");
        }
    }

    public function viewProfile(Request $request, $id)
    {
        $user = Admin::find($id);
        // echo '<pre>';
        // print_r($user);
        return view('admin.profile', compact('user'));
    }
    public function logout()
    {


        if (session()->has('email', 'id')) {
            session()->forget(['email', 'id']);
            return redirect('admin/login')->with('success', " logout successfully");
        } else {
            return redirect('admin/dashboard')->with('failed', " logout faield, try again");
        }
    }


    public function viewDashboard()
    {
        $admin = Admin::all();
        $genderF = Admin::where('gender', 'F')->get();
        $genderM = Admin::where('gender', 'M')->get();
        $genderO = Admin::where('gender', 'O')->get();

        return view('admin.dashboard', compact('admin', 'genderF', 'genderM', 'genderO'));
    }

    public function viewUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->all(['firstname', 'lastname', 'email', 'gender']))) {
                        if (!empty($request->get('firstname'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['firstname']), $request->get('firstname')) ? true : false;
                            });
                        }

                        if (!empty($request->get('lastname'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['lastname']), $request->get('lastname')) ? true : false;
                            });
                        }

                        if (!empty($request->get('email'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['email']), $request->get('email')) ? true : false;
                            });
                        }

                        if (!empty($request->get('gender'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['gender']), $request->get('gender')) ? true : false;
                            });
                        }

                        if (!empty($request->get('country'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains(Str::lower($row['country']), $request->get('country')) ? true : false;
                            });
                        }

                        // $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        //     if (Str::contains(Str::lower($row['firstname']), Str::lower($request->get('search')))) {
                        //         return true;
                        //     } else if (Str::contains(Str::lower($row['lastname']), Str::lower($request->get('search')))) {
                        //         return true;
                        //     } else if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))) {
                        //         return true;
                        //     } else if (Str::contains(Str::lower($row['gender']), Str::lower($request->get('search')))) {
                        //         return true;
                        //     } else if (Str::contains(Str::lower($row['country']), Str::lower($request->get('search')))) {
                        //         return true;
                        //     } else if (Str::contains(Str::lower($row['created_at']), Str::lower($request->get('search')))) {
                        //         return true;
                        //     }
                        //     return false;
                        // });
                    }
                })
                ->editColumn('gender', function ($row) {
                    if ($row->gender == "M") {
                        return "Male";
                    } elseif ($row->gender == "F") {
                        return "Female";
                    } else {
                        return "Other";
                    }
                })
                ->editColumn('created_at', function ($row) {
                    $formatedDate = get_formatted_date($row->created_at, 'd/m/Y');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="users/edit-user/' . $row->id . '" class="edit btn btn-primary btn-sm d-flex">Edit</a>
                           <a href="users/delete-user/' . $row->id . '" class="delete btn btn-danger btn-sm mt-2 d-flex">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return view('home');
        return view('admin.users');
    }

    public function viewAddAdmin()
    {
        return view('admin.add_admin');
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => "required",
            'cpassword' => 'required|same:password',
            // 'hobby' => 'required'
        ]);
        $admin = new Admin;
        $admin->firstname = $request['firstname'];
        $admin->lastname = $request['lastname'];
        $admin->email = $request['email'];
        $admin->gender = $request['gender'];
        $admin->country = $request['country'];
        $admin->image = $request['image'];
        $admin->password = $request['password'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/cover/', $filename);
            $admin->image = $filename;
        }

        $mail_data = [
            'fromEmail' => "dhruvil.patel23117@gmail.com",
            'email' => $admin->email,
            'password' => $admin->password,
        ];
        // $user = array($admin);
        Mail::send('admin.mail', $mail_data, function ($message) use ($mail_data) {
            $message->from($mail_data['fromEmail']);
            $message->to($mail_data['email']);
            $message->subject("Login Info");
        });
        $admin->save();
        return redirect('/admin/users')->with('status', 'Admin Added successfullhy');
        // return view('admin.add_admin');
    }

    public function viewUpdateAdmin($id)
    {
        $admin = Admin::find($id);
        return view('admin.update_admin', compact('admin'));
    }

    

    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => "required",
            'cpassword' => 'required|same:password',
            // 'hobby' => 'required'
        ]);
        $admin = new Admin;
        $admin->firstname = $request['firstname'];
        $admin->lastname = $request['lastname'];
        $admin->email = $request['email'];
        $admin->gender = $request['gender'];
        $admin->country = $request['country'];
        $admin->image = $request['image'];
        $admin->password = $request['password'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/cover/', $filename);
            $admin->image = $filename;
        }
        // $data = ['name'=> 'dhruvil', 'data'=>'hello dhruvil'];
        // $user['to'] = 'dhruvil.patel23117@gmail.com';

        $mail_data = [
            'fromEmail' => "dhruvil.patel23117@gmail.com",
            'email' => $admin->email,
            'password' => $admin->password,
        ];
        // $user = array($admin);
        Mail::send('admin.mail', $mail_data, function ($message) use ($mail_data) {
            $message->from($mail_data['fromEmail']);
            $message->to($mail_data['email']);
            $message->subject("Login Info");
        });
        $admin->save();


        return redirect('/admin/login')->with('status', 'Registration successfullhy');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',

        ]);

        $admin = Admin::find($id);
        $admin->firstname = $request->input('firstname');
        $admin->lastname = $request->input('lastname');
        $admin->gender = $request->input('gender');
        $admin->country = $request->input('country');


        if ($request->hasFile('image')) {
            $destination = 'uploads/cover/' . $admin->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/cover/', $filename);
            $admin->image = $filename;
            $image = $admin->image;
            $request->session()->put('image', $image);
        }

        if ($admin->update()) {

            return redirect('/admin/users')->with('status', 'User Data Updated Successfully');
        } else {

            return redirect()->back()->with('failed', 'User Data not Updated ');
        }
        // return view('admin.update_admin', compact('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $admin = Admin::find($id);
            $destination = 'uploads/cover/' . $admin->image;


            if (File::exists($destination)) {
                File::delete($destination);
            }
            $admin->delete();

            // return redirect('/admin/users')->with('status', 'Admin Data Deleted Successfully');
        }
        return redirect('/admin/users')->with('status', 'Admin Data Deleted Successfully');
    }

    // public function destroy(Request $request, $id)
    // {
    //     $admin = new Admin;
    //     // $admin = Admin::find($id);
    //     Admin::destroy($id);
    //     $destination = 'uploads/cover/' . $admin->image;


    //     if (File::exists($destination)) {
    //         File::delete($destination);
    //     }
    //     // $admin->delete();

    //     return redirect('/admin/users')->with('status', 'Admin Data Deleted Successfully');

    //     // return response()->json([
    //     //     'status' => 'Record has been deleted successfully!'
    //     // ]);
    // }

    public function deleteAdmin($id)
    {
    }
}
