<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialChat;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class SocialChatController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:socialchat.view', only: ['index', 'show']),
            new Middleware('permission:socialchat.create', only: ['create', 'store']),
            new Middleware('permission:socialchat.edit', only: ['edit', 'update']),
            new Middleware('permission:socialchat.delete', only: ['destroy']),
        ];
    }

    public function edit()
    {
        $socialchat = SocialChat::first();

        return view('admin.socialchat.edit', compact('socialchat'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => ['nullable', 'string'],
            'whatsapp_title' => ['nullable', 'string'],
            'whatsapp_message' => ['nullable', 'string'],
            'facebook_page_id' => ['nullable', 'string'],
        ]);

        SocialChat::updateOrCreate(
            ['id' => 1],
            $request->only([
                'whatsapp_number',
                'whatsapp_title',
                'whatsapp_message',
                'whatsapp_enabled',
                'facebook_page_id'
            ])
        );

        return back()->with('success', 'Settings Updated');
    }
}