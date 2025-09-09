<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //Email servive Welcome email
        session()->flash('success', "User {$user->name} created!");
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //Email service Update email
        session()->flash('success', "User {$user->name} updated!");
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //Email service Delete email
        session()->flash('success', "User {$user->name} deleted!");
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
