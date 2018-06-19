<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostValidationRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;


class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::all();
        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::pluck('name', 'id')->all();
        return view('admin.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostValidationRequest $request)
    {
        $form_data = $request->all();
        $user = Auth::user();
        $post_record = $user->posts()->create($form_data);
        if($file = $request->file('path'))
        {
            $file_name = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/post', $file_name);

            $post_record->photo()->create(['path'=>$file_name]);
        }
        session()->flash('msg', 'Post Created Successfully');
        session()->flash('class', 'alert alert-success');
        return redirect('admin/post');

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
        $data['categories'] = Category::pluck('name', 'id')->all();
        $data['post']       = Post::findOrFail($id);
        return view('admin.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostValidationRequest $request, $id)
    {
        $form_data = $request->all();
        $post = Post::findOrFail($id);
        $post->update($form_data);

        if($file = $request->file('path'))
        {
            $file_name = time(). '_'.$file->getClientOriginalName();
            $file->move('uploads/post', $file_name);

            if($post->photo->first())
            {
                @unlink('uploads/post/'.$post->photo->first()->path);
                $post->photo()->update(['path'=>$file_name]);
            }
            else
            {
                $post->photo()->create(['path'=>$file_name]);
            }
        }
        session()->flash('msg', 'Record Updated Successfully');
        session()->flash('class', 'alert alert-success');

        return redirect('admin/post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        @unlink('uploads/post/'.$post->photo->first()->path);
        $post->delete();

        session()->flash('msg', 'Post Deleted Successfully');
        session()->flash('class', 'alert alert-warning');
        return redirect('admin/post');
    }
}
