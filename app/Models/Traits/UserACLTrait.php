<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{
    public function permissions()
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = array_intersect($permissionsPlan, $permissionsRole);
            
        return $permissions;
    }

    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();
        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if (!in_array($permission->name, $permissions)) {
                    array_push($permissions, $permission->name);
                }
            }
        }    

        return $permissions;
    }

    public function permissionsPlan(): array
    {
        $tenant = Tenant::with('plan.profiles.permissions')->find($this->tenant_id);  
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                if (!in_array($permission->name, $permissions)) {
                    array_push($permissions, $permission->name);
                }
            }
        }

        return $permissions;
    }

    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return $this->tenant_id != null;
    }


}