<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = User::orderBy('id', 'DESC')->paginate(15);
        return view('panel.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('title', 'id')->all();
        return view('panel.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create($request->all() + ['ts_register' => Carbon::now()->timestamp]);
        return redirect()->route('user.index')->with('store', 'New user created');

    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['roles'] = Role::pluck('title', 'id')->all();
        $data['user'] = User::findOrFail($id);
        return view('panel.users.edit', compact('data'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        if ($data['password'] == null) {
            unset($data['password']);
        }
        $data['ts_update'] = Carbon::now()->timestamp;
        User::find($id)->update($data);
        return redirect()->route('user.index')->with('edit', 'The selected user has been updated');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Auth::user()->id) {
            return redirect()->route('user.index')->with('delete-error', 'You could not remove yourself');
        }

        User::destroy($id);
        return redirect()->route('user.index')->with('delete', 'The selected user has been deleted');
    }
}
