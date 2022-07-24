<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->get();

        return PostResource::collection($posts);
    }

    public function store(PostStoreRequest $request)
    {
        $request->merge(['user_id' => 1]);

        $post = Post::create($request->only('title', 'body', 'user_id'));

        foreach ($request->file('images') as $image) {
            $post->images()->create([
                'path' => $image->store('/upload/images'),
            ]);
        }

        $post->categories()->attach($request->category_ids);
        // foreach($request->category_ids as $catId) {
        // DB::table('category_post')->insert([
        //     'post_id' => $post->id,
        //     'category_id' => $catId,
        // ]);
        // }
        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([], 404);
        }

        return PostResource::make($post);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
