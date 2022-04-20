<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->middleware('auth');
        $this->post = $post;
    }

    public function index()
    {
        $posts = Post::with('category')->orderBy('sort_order')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::select(['id', 'name'])->orderBy('sort_order')->get();
        $this->post->sort_order = Post::max('sort_order') + 1;

        return view('post.form', [
            'post'=>$this->post, 
            'categories'=> $categories
        ]);
    }

    public function store(PostRequest $request)
    {
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id'=> $request->category_id,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'status'=> $request->status? $request->status: 0,
            'sort_order' => $request->sort_order,
        ];

        // Begin transaction
        DB::beginTransaction();
        try {
            // Create new Post
            $this->post = Post::create($data);

            $featured_image = $this->uploadImage($request);
            if($featured_image) {
                $this->post->featured_image = $featured_image;
                $this->post->save();
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return false;
        }

        return redirect()->route('post.index')->with([
            'status' => 'success',
            "message" => 'Thêm bài viết thành công'
        ]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if(!$post) {
            return redirect()->back()->with([
                'status' => 'error',
                "message" => 'Không tìm thấy bài viết'
            ]);
        }

        $categories = Category::select(['id', 'name'])->orderBy('sort_order')->get();

        return view('post.form', [
            'post'=> $post, 
            'categories'=> $categories
        ]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if(!$post) {
            return redirect()->back()->with([
                'status' => 'error',
                "message" => 'Không tìm thấy bài viết',
            ]);
        }

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id'=> $request->category_id,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'status'=> $request->status? $request->status: 0,
            'sort_order' => $request->sort_order,
        ];

        // Begin transaction
        DB::beginTransaction();
        try {
            // Update the project
            $post->update($data);

            $featured_image = $this->uploadImage($request);
            if($featured_image) {
                // Delete old image
                if($post->featured_image){
                    unlink("upload/posts/". $post->featured_image);
                }
                $post->featured_image = $featured_image;
                $post->save();
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return false;
        }

        return redirect()->back()->with([
            'status'   => 'success',
            'message' => 'Cập nhật bài viết thành công'
        ]);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if(!$post) {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Không tìm thấy Post'
            ]);
        }
        
        // Delete image
        if($post->featured_image){
            unlink("upload/posts/". $post->featured_image);
        }

        $post->delete();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Xóa Post thành công'
        ]);
    }

    protected function uploadImage($request)
    {
        if($request->hasFile('featured_image')){ 
            $file = $request->file('featured_image');
            //get filename with extension
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $file->move('upload/posts', $filenametostore);
            return $filenametostore;
        }
        return null;
    }

    // Upload file in Ckeditor
    public function upload_file(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->move('upload/articles', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('upload/articles/' . $filenametostore);
            $msg = trans('action.upload_success');
            $res = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $res;
        }
    }
}
