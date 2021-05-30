<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostWithCommentsResource;
use App\Http\Resources\UserPostResource;
use App\Models\category;
use App\Models\Post;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['userPosts', 'store', 'update', 'destroy','admin']);
    }

    public function userPosts()
    {
        return UserPostResource::collection(Auth::user()->posts);
//        return PostResource::collection(Auth::user()->posts);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection(Post::all()->where('limits','=','0'));
    }
    public function admin()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $data = $request->only([ 'name','description', 'category_id']);

        $data['video'] = $request->video->store('/', 'public');

        return Auth::user()->posts()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostWithCommentsResource
     */
    public function show(Post $video)
    {
        if ($video->limits ==1 OR $video->limits ==3) {
            return response('Video is deleted', 402);
        }
        return new PostWithCommentsResource($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $video)
    {
        $user = Auth::user();
        if ($user->isAdmin) {
            $video->limits = $request->limits;
            $video->save();
            return response($video,200);
        } else {
            return response($video,200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
