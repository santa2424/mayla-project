<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10); // أو get() إذا لا تريد Pagination

        return view('admin.messages.index', compact('messages'));
    }
}
