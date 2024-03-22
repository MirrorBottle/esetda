<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use App\Biro;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), 403);

        $users = User::with('biro')->get(['id', 'username', 'name', 'biro_id', 'wa']);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('user_create'), 403);

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('user_create'), 403);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $roles = Role::all()->pluck('title', 'id');
        $biros = Biro::all()->pluck('name', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'biros', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return back()->with('success', 'Berhasil mengubah data pengguna');
    }

    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_show'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), 403);

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function profile()
    {
        $roles = Role::all()->pluck('title', 'id');

        $user = User::findOrFail(Auth::user()->id);

        return view('admin.users.profile', compact('user', 'roles'));
    }

    public function resetPassword($id)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user = User::findOrFail($id);
        $user->update(['password' => '123123']);

        return back()->with('success', 'Berhasil mereset password pengguna');
    }

    public function resetPasswordDisposisi($id)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user = User::findOrFail($id);
        $user->update(['disposition_password' => '123123']);

        return back()->with('success', 'Berhasil mereset password disposisi pengguna');
    }
}
