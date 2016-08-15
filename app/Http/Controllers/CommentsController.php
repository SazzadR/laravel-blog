<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     * @param int $post_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|max:4000'
        ]);

        $post = Post::find($post_id);
        $post->comments()->create($request->all());

        Session::flash('success', 'Comment added successfully!');

        return redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit', compact('comment'));
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
        $comment = Comment::findOrFail($id);

        $this->validate($request, [
            'comment' => 'required|max:4000'
        ]);

        $input = $request->all();
        $comment->fill($input)->save();

        Session::flash('success', 'Comment has been updated!');

        return redirect()->route('posts.show', [$comment->post->id]);
    }

    /**
     * Display comment deletion confirmation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comments.delete', compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();

        Session::flash('success', 'Comment has been deleted.');

        return redirect()->route('posts.show', $post_id);
    }
}
