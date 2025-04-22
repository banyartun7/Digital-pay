<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        $agent = new Agent();
        return view('backend.user.index', compact('users', 'agent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        User::create($request->validated());
        return redirect('/admin/user')->with('create', config('alert.user.create'));
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
    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated() + ['password' => empty($request->password) ? $user->password : $request->password]);
        return redirect('/admin/user')->with('update', config('alert.user.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/user')->with('delete', config('alert.user.delete'));
    }
}
