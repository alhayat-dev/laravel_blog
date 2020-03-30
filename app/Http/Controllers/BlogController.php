<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     *  Shows the limit of the posts to be displayed
     * @var int
     */
    protected $limit = 3;

    /**
     * @return Factory|View
     */
    public function index()
    {
        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
        return view('blog.index')->with('posts', $posts);
    }

    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }
}
