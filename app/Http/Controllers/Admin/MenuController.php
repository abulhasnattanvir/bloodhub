<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class MenuController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:menu.view', only: ['index', 'show']),
            new Middleware('permission:menu.create', only: ['create', 'store']),
            new Middleware('permission:menu.edit', only: ['edit', 'update']),
            new Middleware('permission:menu.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $menus = Menu::with('parent')
            ->orderBy('sort_order', 'asc')
            ->paginate(20);

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->get();

        return view('admin.menus.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'nullable|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        Menu::create([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'target_blank' => $request->has('target_blank'),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu Created');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')->get();

        return view('admin.menus.edit', compact('menu', 'parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'nullable|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $menu->update([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'target_blank' => $request->has('target_blank'),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu Updated');
    }

    public function sort(Request $request)
    {
        $menus = $request->input('menus', []);

        if (empty($menus)) {
            return response()->json([
                'status' => false,
                'message' => 'No menu data received'
            ]);
        }

        try {
            foreach ($menus as $index => $menu) {
                Menu::where('id', $menu['id'])->update([
                    'sort_order' => $index + 1,           // Start from 1
                    'parent_id'  => $menu['parent_id'] ?? null,
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Menu order updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error updating order: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back()->with('success', 'Menu Deleted');
    }
}