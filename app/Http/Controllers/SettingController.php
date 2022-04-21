<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->middleware('auth');
        $this->setting = $setting;
    }

    public function index()
    {
        $data = Setting::all();
        $settings = array();
        foreach($data as $item) {
            $settings[$item->key] = $item->value;
        }

        return view('setting.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $setting_keys = Setting::pluck('key')->toArray();

        $newOptions = array();

        foreach ($data as $key=>$value) {
            if(in_array($key, $setting_keys)) {
               Setting::where('key', $key)->update(['value'=>$value]);
            } else {
                array_push($newOptions, [
                    'key'=> $key,
                    'value'=> $value
                ]);
            }
        }

        if(count($newOptions) > 0) {
            Setting::insert($newOptions);
        }

        return redirect()->back()->with([
            'status'=> 'success',
            'message'=> 'Cập nhật thành công'
        ]);
    }

    public function clearCache()
    {
        try {
            \Artisan::call('cache:clear');
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status'=> 'error',
                'message'=> 'Đã xảy ra lỗi'
            ]);
        }

        return redirect()->back()->with([
            'status'=> 'success',
            'message'=> 'Xóa Cache thành công'
        ]);
    }
    public function clearView()
    {
        try {
            \Artisan::call('view:clear');
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status'=> 'error',
                'message'=> 'Đã xảy ra lỗi'
            ]);
        }

        return redirect()->back()->with([
            'status'=> 'success',
            'message'=> 'Xóa View thành công'
        ]);
    }
    public function clearRoute()
    {
        try {
            \Artisan::call('route:clear');
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status'=> 'error',
                'message'=> 'Đã xảy ra lỗi'
            ]);
        }

        return redirect()->back()->with([
            'status'=> 'success',
            'message'=> 'Xóa Router thành công'
        ]);
    }
}