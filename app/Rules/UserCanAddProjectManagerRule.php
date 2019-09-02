<?php

namespace App\Rules;

use App\Role;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class UserCanAddProjectManagerRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $roles = Role::whereIn('id', request()->input('roles'))->get();

        return array_intersect(['area-manager'], $roles->pluck('name')->toArray());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can only add project manager if the user has a area manager role';
    }
}
