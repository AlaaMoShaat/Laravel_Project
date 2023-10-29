<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny() //index
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('Index Admin')
                ? $this->allow()
                :  $this->deny('This is Cant Make Index Admin');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Index Admin')
                ? $this->allow()
                :  $this->deny('This is Cant Make Index Author');
        } else {
            return auth()->user()->hasPermissionTo('Index Admin')
                ? $this->allow()
                :  $this->deny('This is Cant Make Index Admin');
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Admin $admin) //show
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create() //create
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('Create Admin')
                ? $this->allow()
                :  $this->deny('This is Cant Make Create Admin');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Create Admin')
                ? $this->allow()
                :  $this->deny('This is Cant Make Create Admin');
        } else {
            return auth()->user()->hasPermissionTo('Create Admin')
                ? $this->allow()
                :  $this->deny('This is Cant Make Create Admin');
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Admin $admin) //edit
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Admin $admin) //distroy
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Admin $admin)
    {
        //
    }
}
