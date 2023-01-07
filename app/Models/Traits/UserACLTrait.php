<?php

namespace App\Models\Traits;

trait UserACLTrait
{
   public function permissions()
   {
       $tenant = auth()->user()->tenant;
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