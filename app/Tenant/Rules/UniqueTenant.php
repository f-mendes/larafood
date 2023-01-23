<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagementTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{

    protected $table, $value, $collumn;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $value = null, $collumn = 'id')
    {
        $this->table = $table;
        $this->value = $value;
        $this->collumn = $collumn;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tenantId = app(ManagementTenant::class)->getTenantIdentify();

        $validate = DB::table($this->table)
                ->where($attribute, $value)
                ->where('tenant_id' , $tenantId)
                ->first();
        
        
        if ($validate && $validate->{$this->collumn} == $this->value ) return true;

        return is_null($validate);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This value already exist.';
    }
}
