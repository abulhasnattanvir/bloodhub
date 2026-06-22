<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class UserRoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:userrole.view', only: ['index', 'show']),
            new Middleware('permission:userrole.create', only: ['create', 'store']),
            new Middleware('permission:userrole.edit', only: ['edit', 'update']),
            new Middleware('permission:userrole.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $users = User::with('roles')->latest()->get();

        return view('admin.userrole.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRole = $user->roles->pluck('name')->first(); // single role system

        return view('admin.userrole.edit', compact('user', 'roles', 'userRole'));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return response()->json([
            'status' => true,
            'message' => 'Role assigned successfully',
        ]);
    }
}