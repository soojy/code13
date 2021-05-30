<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\LikeStoreRequest;
use App\Models\like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Post $post, LikeStoreRequest $request)
    {
        return $post->likes()->create([
            'isDislike' => $request->isDislike,
            'user_id' => Auth::user()->id
        ]);
    }
}
