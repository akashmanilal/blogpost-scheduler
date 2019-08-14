<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BlogpostResource;
use App\Blogpost;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use App\Http\Requests\BlogpostCreateRequest;
use App\Http\Requests\BlogpostUpdateRequest;

class BlogpostController extends Controller
{
    //

    public function index(): JsonResource {
        $query = Blogpost::where('published_at','<=', Carbon::now());
        return BlogpostResource::collection($query->paginate(1));
    }

    public function show(Blogpost $blogpost): JsonResource {
        return new BlogpostResource($blogpost);
    }

    public function create(BlogpostCreateRequest $request): JsonResource {
        $data = array_merge(
            ['published_at' => Carbon::now()],
            $request->validated(),
            ['user_id' => $request->user()->id]);

        $data['slug'] = $data['title'];

        return new BlogpostResource(Blogpost::create($data));
    }

    public function update(BlogpostUpdateRequest $request, Blogpost $blogpost): JsonResource {
        $blogpost->update($request->validated());

        return new BlogpostResource($blogpost);
    }

    public function delete(Blogpost $blogpost): JsonResource {
        $blogpost->delete();

        return $blogpost;
    }

    public function userBlogposts(User $user): JsonResource {
        return BlogpostsResource::collection($user->blogposts);
    }
}
