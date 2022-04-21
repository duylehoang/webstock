<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use PhpParser\Node\Expr\AssignOp\Pow;

class HomeController extends Controller
{
    public function index() 
    {
        return view('client.home');
    }

    public function knowledge()
    {
        $categories = Category::withCount('posts')->where('type', 1)->orderBy('sort_order')->get();
        return view('client.knowledge.index', compact('categories'));
    }

    public function knowledgeArticle($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->first();
        if(!$post) {
            abort(404);
        } 

        $otherPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderBy('sort_order')
            ->get();

        return view('client.knowledge.article', compact('post', 'otherPosts'));
    }

    public function sharing()
    {
        $cate_share = Category::where('type', 2)->first();
        if($cate_share) {
            $posts = Post::where('category_id', $cate_share->id)
                ->where('status', 1)
                ->orderBy('sort_order')
                ->get();
        } else {
            $posts = [];
        }
      
        return view('client.sharing.index', compact('posts'));
    }

    public function sharedArticle($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->first();
        if(!$post) {
            abort(404);
        } 

        $otherPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderBy('sort_order')
            ->get();

        return view('client.sharing.article', compact('post', 'otherPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if(!$category) {
            abort(404);
        }

        $posts = Post::where('category_id', $category->id)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('client.category', compact('category', 'posts'));
    }

    public function contact()
    {
        return view('client.contact');
    }
}
