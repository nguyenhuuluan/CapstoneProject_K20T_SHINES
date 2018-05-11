<?php

namespace App\Policies;

use App\Account;
use App\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the company.
     *
     * @param  \  $user
     * @param  \App\Company  $company
     * @return mixed
     */

    public function before(Account $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function view(Account $user)
    {
        return ($this->getRole($user) &&($this->getPermission($user,[9,10,11,12])));
        
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create(Account $user)
    {
        return $this->getPermission($user,[9]);
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function update(Account $user)
    {
        return $this->getPermission($user,[11]);
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function delete(Account $user)
    {
        return $this->getPermission($user,[10]);
    }

    protected function getRole($user)
    {
        foreach ($user->roles as $role) {
            if ($role->name =='Staff') {
                return true;
            }
        }
        return false;
    }
    protected function getPermission($user, $per_id)
    {
        if(count(array_intersect(array_column($user->permissions->all(), 'id'),$per_id))>0)
            {return true;}
        // foreach($user->permissions as $permission)
        // {
        //     if(($permission->id == $per_id) && $this->getRole($user))
        //         {return true;}
        // }
        return false;
    }
}
