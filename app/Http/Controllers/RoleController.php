<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('roles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->input('name')]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function show($id): View
    {
        $role = Role::find($id);
        return view('roles.show', compact('role'));
    }

    public function edit($id): View
    {
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Role::find($id)->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
