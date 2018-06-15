<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::pluck('name', 'id')->all();

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $form_data = $request->all();
        //dd($form_data);
        $form_data['password'] = bcrypt($request->password);
        $user = User::create($form_data);
        if($file = $request->file('photo_id'))
        {
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/user', $name);

            $user->photo()->create(['path'=>$name]);
        }
        Session::flash('class', 'alert alert-success');
        Session::flash('msg', 'User Created Successfully');
        return redirect('admin/user');


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

        $data['roles'] = Role::pluck('name', 'id')->all();
        $data['user']   = User::findOrFail($id);
        if( $photo_record_status = $data['user']->photo->first())
        {
            $data['profile_photo'] = $photo_record_status->path;
        }
        else
        {
            $data['profile_photo'] = 'http://placeholde.com/100x100';
        }


        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        if($request->password)
        {
            $form_data = $request->except('_method', '_token', 'photo_id');
            $form_data['password'] = bcrypt($request->password);
        }
        else
        {
            $form_data = $request->except('password','_method', '_token', 'photo_id');
        }

        $user = User::where(['id'=>$id])->firstOrFail();
        $user->update($form_data);

        if($file = $request->file('photo_id'))
        {
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/user', $name);

            $user->photo()->update(['path'=>$name]);
        }
        Session::flash('class', 'alert alert-success');
        Session::flash('msg', 'User Updated Successfully');
        return redirect('admin/user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->photo->first())
        {
            unlink(public_path($user->photo->first()->path));
        }

        $user->delete();
        Session::flash('class', 'alert alert-warning');
        Session::flash('msg', 'User Deleted Successfully');
        return redirect('admin/user');
    }
}
