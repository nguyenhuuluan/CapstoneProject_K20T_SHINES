<?php

namespace App\Policies;

use App\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the account.
     *
     * @param  \  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function view(Account $user)
    {
         return $this->getRole($user);
    }

    public function staff(Account $user)
    {
         return $this->getRole($user);
    }
    /**
     * Determine whether the user can create accounts.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create(Account $user)
    {
        return $this->getRole($user);
    }

    /**
     * Determine whether the user can update the account.
     *
     * @param  \  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function update(Account $user)
    {
        return $this->getRole($user);
    }

    /**
     * Determine whether the user can delete the account.
     *
     * @param  \  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function delete(Account $user)
    {
        return $this->getRole($user);
    }

    protected function getRole($user)
    {
        foreach ($user->roles as $role) {
            if ($role->name == 'Admin') {
                return true;
            }
        }
        return false;
    }
}
