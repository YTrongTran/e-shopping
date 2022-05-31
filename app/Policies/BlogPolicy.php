<?php

namespace App\Policies;

use App\Model\Blog;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAcces(config('permissions.accessBlog.list-blog'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->checkPermissionAcces(config('permissions.accessBlog.add-blog'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function update(User $user, $id)
    {

        $blog = Blog::find($id);
        if ($user->id == $blog->user_id || Auth::user()->email == 'admin@gmail.com') {
            return $user->checkPermissionAcces(config('permissions.accessBlog.edit-blog'));
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function delete(User $user, $id)
    {

        $blog = Blog::find($id);
        if ($user->id == $blog->user_id || Auth::user()->email == 'admin@gmail.com') {
            return $user->checkPermissionAcces(config('permissions.accessBlog.deleted-blog'));
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}