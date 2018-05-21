<?php

namespace App\Policies;

use App\Account;
use App\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the =Blog.
     *
     * @param  \  $user
     * @param  \App\=Blog  $=Blog
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
        return ($this->getRole($user) &&($this->getPermission($user,[1,2,3,4])));
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
        return $this->getPermission($user,[1]);
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
        return $this->getPermission($user,[3]);
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
        return $this->getPermission($user,[2]);
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
