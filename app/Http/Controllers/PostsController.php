<?php namespace App\Http\Controllers;

use App\Post;
use Auth;

/**
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    public function index()
    {
        return $this->respondWithData(Post::with('user')->all()->toArray());
    }

    public function show($id)
    {
        return $this->respondWithData(Post::find($id)->with('user')->get()->toArray());
    }

    public function store()
    {
        $rules = [
            'text' => 'required',
        ];

        $input = $_POST;

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        $post = new Post;
        $post->content = $input['content'];
        $post->user()->associate(Auth::user());
        $post->save();

        return $this->show($post->id);
    }

//    public function delete() {}
}
