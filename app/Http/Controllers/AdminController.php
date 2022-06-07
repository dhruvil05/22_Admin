<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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

    public function viewLogin()
    {
        return view('admin.Register.login');
    }

    public function viewDashboard()
    {
        $admin = Admin::all();
        return view('admin.dashboard', compact('admin'));
    }

    public function viewUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    // if (!empty($request->get('email'))) {
                    //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //         return Str::contains($row['email'], $request->get('email')) ? true : false;
                    //     });
                    // }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['firstname']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['lastname']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['gender']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['country']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['created_at']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
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
                           <a href="users/delete-user/' . $row->id . '" class="delete btn btn-danger btn-sm mt-2 d-flex" >Delete</a>';

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
        $admin->save();

        return redirect('/admin/users')->with('status', 'Admin Added successfullhy');
        // return view('admin.add_admin');
    }

    public function viewUpdateAdmin($id)
    {
        $admin = Admin::find($id);
        return view('admin.update_admin', compact('admin'));
    }
    public function updateAdmin(Request $request, $id)
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
        }

        if ($admin->update()) {

            return redirect('/admin/users')->with('status', 'User Data Updated Successfully');
        } else {

            return redirect('/admin/users')->with('failed', 'User Data not Updated ');
        }
        // return view('admin.update_admin', compact('admin'));
    }

    

    public function index()
    {
        //
    }

    public function login(Request $request)
    {

        echo "<pre>";
        print_r($request->all());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteAdmin($id){
       
            $admin = Admin::find($id);
            $destination = 'uploads/cover/' . $admin->image;
    
    
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $admin->delete();
       
        return redirect('/admin/users')->with('status', 'Admin Data Deleted Successfully');
    }
}
