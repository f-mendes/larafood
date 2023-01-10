<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleUserController extends Controller
{
    protected $role, $user;

    public function __construct(Role $role, User $user)
    {

        $this->role = $role;
        $this->user = $user;

        $this->middleware(['can:users']);
    }

    public function roles($idUser)
    {
        $user = $this->user->find($idUser);
        
        if(!$user)
            return redirect()->back();

        $roles = $user->roles()->paginate();

        //dd($roles);

        return view('admin.pages.users.roles.index', compact('user', 'roles'));
    }

    public function rolesAvailable(Request $request, $idUser)
    {
        
        if(!$user = $this->user->find($idUser))
            return redirect()->back();


        $filters = $request->except('_token');
        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters'));
    }

    public function attachRolesUser(Request $request, $idUser)
    {
        if(!$user = $this->user->find($idUser))
            return redirect()->back();

        if(!$request->roles || count($request->roles) == 0){
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um cargo');
        }

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }

    public function detachRoleUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if(!$user || !$role)
            return redirect()->back();

        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id);
    }
}
