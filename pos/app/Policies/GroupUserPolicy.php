<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GroupUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupUserPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:GroupUser');
    }

    public function view(AuthUser $authUser, GroupUser $groupUser): bool
    {
        return $authUser->can('View:GroupUser');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:GroupUser');
    }

    public function update(AuthUser $authUser, GroupUser $groupUser): bool
    {
        return $authUser->can('Update:GroupUser');
    }

    public function delete(AuthUser $authUser, GroupUser $groupUser): bool
    {
        return $authUser->can('Delete:GroupUser');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:GroupUser');
    }

    public function restore(AuthUser $authUser, GroupUser $groupUser): bool
    {
        return $authUser->can('Restore:GroupUser');
    }

    public function forceDelete(AuthUser $authUser, GroupUser $groupUser): bool
    {
        return $authUser->can('ForceDelete:GroupUser');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:GroupUser');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:GroupUser');
    }

    public function replicate(AuthUser $authUser, GroupUser $groupUser): bool
    {
        return $authUser->can('Replicate:GroupUser');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:GroupUser');
    }

}