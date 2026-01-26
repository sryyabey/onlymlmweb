<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DocTag;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocTagPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DocTag');
    }

    public function view(AuthUser $authUser, DocTag $docTag): bool
    {
        return $authUser->can('View:DocTag');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DocTag');
    }

    public function update(AuthUser $authUser, DocTag $docTag): bool
    {
        return $authUser->can('Update:DocTag');
    }

    public function delete(AuthUser $authUser, DocTag $docTag): bool
    {
        return $authUser->can('Delete:DocTag');
    }

    public function restore(AuthUser $authUser, DocTag $docTag): bool
    {
        return $authUser->can('Restore:DocTag');
    }

    public function forceDelete(AuthUser $authUser, DocTag $docTag): bool
    {
        return $authUser->can('ForceDelete:DocTag');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DocTag');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DocTag');
    }

    public function replicate(AuthUser $authUser, DocTag $docTag): bool
    {
        return $authUser->can('Replicate:DocTag');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DocTag');
    }

}