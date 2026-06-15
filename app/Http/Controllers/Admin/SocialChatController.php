<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialChat;
class SocialChatController extends Controller
{
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