<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Profile;

class PermissionProfileController extends Controller
{
    protected $permission, $profile;

    public function __construct(Permission $permission, Profile $profile)
    {

        $this->permission = $permission;
        $this->profile = $profile;

        $this->middleware(['can:profiles']);
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        
        if(!$profile)
            return redirect()->back();

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.index', compact('profile', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $idProfile)
    {
        
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();


        $filters = $request->except('_token');
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission)
            return redirect()->back();

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);
    }
}
