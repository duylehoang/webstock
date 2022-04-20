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
        return view('setting.index', compact('settings'));
    }

}