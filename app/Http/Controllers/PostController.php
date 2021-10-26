<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getAllPosts();
        
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            $this->postService->createPost($request->all(), auth()->user());

            return redirect()->route('posts.index')->with('success', 'Add successfully!');
        } catch (\Exception $e) {
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->postService->findPostById($id);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $post = $this->postService->findPostById($id);
            
            return view('admin.post.edit', compact('post'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $this->postService->updatePost($request->all(), $id, auth()->user());
            
            return redirect()->route('posts.index')->with('success', 'Update post successfully!');
        } catch (\Exception $e) {
            abort(500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->postService->deletePost($id);
            
            return redirect()->back()->with('success', 'Delete post successfully!');
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function activePost($id)
    {
        try {
            $this->postService->activePost($id);
            
            return redirect()->back();
        } catch (\Exception $e) {
            abort(500);
        }     
    }   
}
