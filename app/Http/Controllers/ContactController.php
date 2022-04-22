<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderBy('id')->get();

        return view('contact.index', compact('contacts'));
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        if(!$contact) {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Không tìm thấy Contact'
            ]);
        }

        $contact->delete();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Xóa Contact thành công'
        ]);
    }
}
