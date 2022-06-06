<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewRegister(){
        return view('admin.Register.register');
    }

    public function viewLogin(){
        return view('admin.Register.login');
    }

    public function viewDashboard(){
        return view('admin.dashboard');

    }

    public function viewUsers(){
        return view('admin.users');
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
        $admin->firstname= $request['firstname'];
        $admin->lastname= $request['lastname'];
        $admin->email= $request['email'];
        $admin->gender= $request['gender'];
        $admin->country= $request['country'];
        $admin->image= $request['image'];
        $admin->password= $request['password'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/cover/', $filename);
            $admin->image = $filename;
        }
        $admin->save();

        return redirect('/admin/login')->with('status','Registration successfullhy');
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
}
