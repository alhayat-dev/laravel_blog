<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
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
        $categories = Category::with(['posts' => function($query){
            $query->published();
        }])->orderBy('title', 'asc')
            ->get();

        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
        return view('blog.index')->with(compact('posts','categories'));
    }

    public function category($id)
    {
        $categories = Category::with(['posts' => function($query){
            $query->published();
        }])
            ->orderBy('title', 'asc')
            ->get();

        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->where('category_id', $id)
            ->simplePaginate($this->limit);
        return view('blog.index')->with(compact('posts','categories'));
    }

    public function show(Post $post)
    {
        return view('blog.show')->with(compact('post','categories'));
    }


}
