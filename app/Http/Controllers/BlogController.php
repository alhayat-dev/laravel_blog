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
        $categories = $this->getAllCategories();

        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view('blog.index')->with(compact('posts','categories'));
    }

    public function category(Category $category)
    {
        $categoryName = $category->title;
        $categories = $this->getAllCategories();

        $posts = $category->posts()
                          ->latestFirst()
                          ->with('author')
                          ->published()
                          ->simplePaginate($this->limit);

        return view('blog.index')->with(compact('posts','categories', 'categoryName'));
    }

    public function show(Post $post)
    {
        $categories = $this->getAllCategories();
        return view('blog.show')->with(compact('post','categories'));
    }

    /**
     * @return array
     */
    public function getAllCategories()
    {
        /** @var array $categories */
        $categories = Category::with(['posts' => function($query){
            $query->published();
            }])->orderBy('title', 'asc')
              ->get();
        return $categories;
    }

}
