<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DocCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DocCategory');
    }

    public function view(AuthUser $authUser, DocCategory $docCategory): bool
    {
        return $authUser->can('View:DocCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DocCategory');
    }

    public function update(AuthUser $authUser, DocCategory $docCategory): bool
    {
        return $authUser->can('Update:DocCategory');
    }

    public function delete(AuthUser $authUser, DocCategory $docCategory): bool
    {
        return $authUser->can('Delete:DocCategory');
    }

    public function restore(AuthUser $authUser, DocCategory $docCategory): bool
    {
        return $authUser->can('Restore:DocCategory');
    }

    public function forceDelete(AuthUser $authUser, DocCategory $docCategory): bool
    {
        return $authUser->can('ForceDelete:DocCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DocCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DocCategory');
    }

    public function replicate(AuthUser $authUser, DocCategory $docCategory): bool
    {
        return $authUser->can('Replicate:DocCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DocCategory');
    }

}