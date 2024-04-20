<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('Back.Messages.index', compact('messages'));
    }

    public function destroy($id)
    {
        $messages = Message::findOrFail($id);
        $messages->delete();
        return redirect()->route('admin-messages.index')->with('success', 'Message deleted successfully!');
    }
}
