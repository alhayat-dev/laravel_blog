<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\User;
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
        $popularPosts = $this->popularPosts();
        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view('blog.index')->with(compact('posts','categories', 'popularPosts'));
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
        $popularPosts = $this->popularPosts();
        $categories = $this->getAllCategories();
        return view('blog.show')->with(compact('post','categories', 'popularPosts'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;
        $categories = $this->getAllCategories();

        $posts = $author->posts()
            ->latestFirst()
            ->with('category')
            ->published()
            ->simplePaginate($this->limit);

        return view('blog.index')->with(compact('posts','categories', 'authorName'));
    }

    /**
     * @return array
     */
    public function popularPosts()
    {
        $popularPosts = Post::published()->popular()->take(3)->get();
        return $popularPosts;
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
