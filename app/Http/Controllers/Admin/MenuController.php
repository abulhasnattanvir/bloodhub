<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    //frontend view
    // View::composer('*', function ($view) {

    //     $menus = Menu::with('children')
    //         ->whereNull('parent_id')
    //         ->where('status', 1)
    //         ->orderBy('sort_order')
    //         ->get();

    //     $view->with('menus', $menus);
    // });

    public function index()
    {
        $menus = Menu::with('parent')
            ->orderBy('sort_order')
            ->get();

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->get();

        return view('admin.menus.create', compact('parents'));
    }

    public function store(Request $request)
    {
        Menu::create($request->all());

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
        $menu->update($request->all());

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu Updated');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back()->with('success', 'Menu Deleted');
    }
}