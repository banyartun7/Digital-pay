<?php

namespace App\Http\Controllers\backend;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\AdminUserUpdateRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = AdminUser::latest()->get();
        return view('backend.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserRequest $request)
    {
        AdminUser::create($request->validated());
        return redirect('/admin/admin-user')->with('create', config('alert.admin.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminUser $adminUser)
    {
        return view('backend.admin.edit', compact('adminUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserUpdateRequest $request, AdminUser $adminUser)
    {
        $adminUser->update($request->validated() + ['password' => empty($request->password) ? $adminUser->password : $request->password]);
        return redirect('/admin/admin-user')->with('update', config('alert.admin.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();
        return redirect('/admin/admin-user')->with('delete', config('alert.admin.delete'));
    }
}
