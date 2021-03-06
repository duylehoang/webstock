<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index() 
    {
        $settings = load_settings();

        $latest_post = Post::with('category')
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();
            
        return view('client.home', compact('settings', 'latest_post'));
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

    public function subscribe(Request $request) 
    {
        // nh???n t???i ??a 5000 li??n h???
        if(Contact::count() > 5000) {
            return false;
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->content = $request->content;
        $contact->save();

        return redirect()->back()->with([
            'status'=> 'success',
            'message' => '????ng k?? th??nh c??ng'
        ]);
    }
}
