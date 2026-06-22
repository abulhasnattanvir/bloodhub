<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessages;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class ContactMessageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:message.view', only: ['index', 'show']),
            new Middleware('permission:message.create', only: ['create', 'store']),
            new Middleware('permission:message.edit', only: ['edit', 'update']),
            new Middleware('permission:message.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $messages = ContactMessages::latest()->paginate(15);
        return view('admin.contact.messages', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessages::findOrFail($id);
        if ($message->status === 'new') {
            $message->markAsRead();
        }
        return view('admin.contact.message-show', compact('message'));
    }

    public function markAsRead($id)
    {
        $message = ContactMessages::findOrFail($id);
        $message->markAsRead();
        return back()->with('success', 'Message marked as read.');
    }

    public function destroy($id)
    {
        $message = ContactMessages::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message deleted successfully.');
    }


}