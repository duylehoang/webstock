<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->category = $category;
    }

    public function index()
    {
        $categories = Category::with('parentCategory')->orderBy('sort_order')->get();

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $parents = Category::where('parent', 0)->orderBy('sort_order')->get();

        $this->category->sort_order = Category::max('sort_order') + 1;

        return view('category.form', [
            'category'=> $this->category,
            'parents' => $parents
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'type'=>$request->type,
            'parent' => $request->parent? $request->parent: 0,
            'sort_order'=> $request->sort_order
        ];

        // Begin transaction
        DB::beginTransaction();
        try {
            // Create new category
            $this->category = Category::create($data);

            $banner = $this->uploadImage($request);
            if($banner) {
                $this->category->banner = $banner;
                $this->category->save();
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return false;
        }

        return redirect()->route('category.index')->with([
            'status'=> 'success',
            'message'=> 'Thêm Category thành công'
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return redirect()->back()->with([
                'status'=> 'error',
                'message'=> 'Không tìm thấy Category'
            ]);
        }

        $parents = Category::where('parent', 0)
            ->where('id', '!=', $id)
            ->orderBy('sort_order')
            ->get();

        return view('category.form', compact('category', 'parents'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if(!$category) {
            return redirect()->back()->with([
                'status'=> 'error',
                'message'=> 'Không tìm thấy Category'
            ]);
        }

        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'type'=>$request->type,
            'parent' => $request->parent? $request->parent: 0,
            'sort_order'=> $request->sort_order
        ];

        // Begin transaction
        DB::beginTransaction();
        try {
            // Update the category
            $category->update($data);

            $banner = $this->uploadImage($request);
            if($banner) {
                // Delete old banner
                if($category->banner) {
                    unlink("upload/categories/". $category->banner);
                }
                $category->banner = $banner;
                $category->save();
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return false;
        }

        return redirect()->back()->with([
            'status'=> 'success',
            'message'=> 'Cập nhật Category thành công'
        ]);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Không tìm thấy Category'
            ]);
        }

        $count_posts = $category->posts->count();
        if($count_posts > 0) {
            return response()->json([
                'status'=> 'warning',
                'message'=> 'Catagory này đã có '. $count_posts . ' bài viết, bạn không thể xóa'
            ]);
        }
        
        if($category->banner) {
            unlink("upload/categories/". $category->banner);
        }

        $category->delete();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Xóa Category thành công'
        ]);
    }

    protected function uploadImage($request)
    {
        if($request->hasFile('banner')){ 
            $file = $request->file('banner');

            //get filename with extension
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $file->move('upload/categories', $filenametostore);
            return $filenametostore;
        }
        return null;
    }
}
