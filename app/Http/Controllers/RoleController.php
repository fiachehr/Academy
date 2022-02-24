<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Role::orderBy('id', 'DESC')->paginate(15);
        return view('panel.roles.index', compact('list'));
    }

    /**
     * Show the form for creating a new role.
     *
     */
    public function create()
    {
        $data['modules'] = ['Role', 'User', 'Course', 'Lesson', 'HomeWork', 'Financial', 'Shop'];
        return view('panel.roles.create', compact('data'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->except('permissions') + ['ts_register' => Carbon::now()->timestamp]);
        foreach ($request->all()['permissions'] as $value) {
            $role->permissions()->create(['module' => $value[0], 'type' => $value[2]]);
        }
        return redirect()->route('role.index')->with('store', 'New user role created');

    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('panel.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->except('permissions') + ['ts_update' => Carbon::now()->timestamp]);
        $role->permissions()->delete();
        foreach ($request->all()['permissions'] as $value) {
            $role->permissions()->create(['module' => $value[0], 'type' => $value[2]]);
        }
        return redirect()->route('role.index')->with('edit', 'The selected user role has been updated');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('role.index')->with('delete', 'The selected user role has been deleted');
    }
}
