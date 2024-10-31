<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost (Request $request){

        $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required'

        ]);
       $incomingFields['user_id'] = $request->user()->id;
        Post::create($incomingFields);
        return redirect('/');  

    }



    public function showEditScreen (Post $post) {

        if(auth()->id()!== $post["user_id"]){
            return redirect('/');
        }

        return view('edit-post', ['post' =>$post]);


    }

    public function editPost (Request $request, Post $post ){
        $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required'
        ]
        );
     $post->update($incomingFields);
     return redirect('/');
    }

    public function deletePost (Post $post) {
        // $post = Post::where('id', $post->id)->get()->first();
        $post->delete();
        return redirect('/');

    }
}
