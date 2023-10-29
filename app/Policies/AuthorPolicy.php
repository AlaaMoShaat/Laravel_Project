<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('Index Author')
                ? $this->allow()
                :  $this->deny('This is Cant Make Index Author');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Index Author')
                ? $this->allow()
                :  $this->deny('This is Cant Make Index Author');
        } else {
            return auth()->user()->hasPermissionTo('Index Author')
                ? $this->allow()
                :  $this->deny('This is Cant Make Index Author');
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('Create Author')
                ? $this->allow()
                :  $this->deny('This is Cant Make Create Author');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Create Author')
                ? $this->allow()
                :  $this->deny('This is Cant Make Create Author');
        } else {
            return auth()->user()->hasPermissionTo('Create Author')
                ? $this->allow()
                :  $this->deny('This is Cant Make Create Author');
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Author $author)
    {
        //
    }
}
