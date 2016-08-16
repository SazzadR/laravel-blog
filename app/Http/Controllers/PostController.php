<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Purifier;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_results = Category::orderBy('id', 'asc')->get(['id', 'name']);
        $tags_results = Tag::orderBy('id', 'asc')->get(['id', 'name']);
        $categories = [];
        $tags = [];

        foreach ($categories_results as $category) {
            $categories[$category->id] = $category->name;
        }
        foreach ($tags_results as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body' => 'required'
        ]);

        $request->merge(['body' => Purifier::clean($request->body)]);

        $post = Post::create($request->all());;
        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog post was successfully saved!');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return view('posts.show', compact('post'));
        }
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $categories_results = Category::orderBy('id', 'asc')->get(['id', 'name']);
        $tags_results = Tag::orderBy('id', 'asc')->get(['id', 'name']);
        $categories = [];
        $tags = [];
        foreach ($categories_results as $category) {
            $categories[$category->id] = $category->name;
        }
        foreach ($tags_results as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        return view('posts.edit', compact('post', 'categories', 'tags'));
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
        $post = Post::find($id);

        if ($request->input('slug') == $post->slug) {
            $this->validate($request, [
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'body' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                'body' => 'required'
            ]);
        }

        $request->merge(['body' => Purifier::clean($request->body)]);

        $input = $request->all();
        $post->fill($input)->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync([], true);
        }

        Session::flash('success', 'Post has been successfully updated.');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        Session::flash('success', 'Post has been deleted');

        return redirect()->route('posts.index');
    }
}
