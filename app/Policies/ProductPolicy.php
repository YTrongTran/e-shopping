<?php

namespace App\Policies;

use App\Model\Products;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
     * @param  \App\Products  $products
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAcces(config('permissions.accessProduct.list-product'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAcces(config('permissions.accessProduct.add-product'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Products  $products
     * @return mixed
     */
    public function update(User $user, $id)
    {
        $products = Products::find($id);
        if ($user->id == $products->user_id ) {
            return $user->checkPermissionAcces(config('permissions.accessProduct.edit-product'));
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Products  $products
     * @return mixed
     */
    public function delete(User $user, $id)
    {
        $products = Products::find($id);
        if ($user->id == $products->user_id) {
            return $user->checkPermissionAcces(config('permissions.accessProduct.deleted-product'));
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Products  $products
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
     * @param  \App\Products  $products
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}