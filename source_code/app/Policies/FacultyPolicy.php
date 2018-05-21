<?php

namespace App\Policies;

use App\Account;
use App\Faculty;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacultyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the faculty.
     *
     * @param  \  $user
     * @param  \App\Faculty  $faculty
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
        // return ($this->getRole($user) || $this->getPermission($user, 8));
        return ($this->getRole($user) &&($this->getPermission($user,[13,14,15,16])));
        // return $this->getPermission($user,[5,6,7,8]);
    }

    /**
     * Determine whether the user can create recruitments.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create(Account $user)
    {
        return $this->getPermission($user,[13]);
    }

    /**
     * Determine whether the user can update the recruitment.
     *
     * @param  \  $user
     * @param  \App\Recruitment  $recruitment
     * @return mixed
     */
    public function update(Account $user)
    {
        return $this->getPermission($user,[15]);
    }

    /**
     * Determine whether the user can delete the recruitment.
     *
     * @param  \  $user
     * @param  \App\Recruitment  $recruitment
     * @return mixed
     */
    public function delete(Account $user)
    {
        return $this->getPermission($user,[14]);
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
