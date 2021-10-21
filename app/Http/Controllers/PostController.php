<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Post\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepo->getPost();
        
        return view('admin.post.index',compact('posts'));
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
    public function store(PostStoreRequest $request)
    {
        $user_id = auth()->user()->id;
        $data = $request->all();
        $image = $request->file('image');
        if($image) {
            $image_name = date("Y.m.d").".".$image->getClientOriginalName();
            if(!is_dir("./upload/post/$user_id")) {
                mkdir("./upload/post/$user_id");
            }
            $image->move(public_path('upload/post/'.$user_id),$image_name);
        }
        $post = $this->postRepo->create([
            'user_id' => $user_id,
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $image_name,
        ]);

        return redirect()->route('posts.index')->with('success','Add successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepo->find($id);
    
        return $post ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepo->find($id);
        return view('admin.post.edit',compact('post'));
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
        $user_id = auth()->user()->id;
        $data = $request->all();
        $image = $request->file('image');
        if($image) {
            $image_name = date("Y.m.d").".".$image->getClientOriginalName();
            if(!is_dir("./upload/post/$user_id")) {
                mkdir("./upload/post/$user_id");
            }
            $image->move(public_path('upload/post/'.$user_id),$image_name);
            $data['image'] = $image_name;
        }
        $post = $this->postRepo->update($id,$data);

        return redirect()->route('posts.index')->with('success','Update post successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->postRepo->delete($id);

        return redirect()->back()->with('success','Delete post successfully!');
    }

    public function activePost($id)
    {
        $post = $this->postRepo->find($id);
        if($post->is_active == 0) {
            $post->is_active = 1;
            $post->publicted_at = Carbon::now();
            $post->save();
        }else {
            $post->is_active = 0;
            $post->publicted_at = null;
            $post->save();
        }
        return redirect()->back();
    }
}
