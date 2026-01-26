<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DocContent;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocContentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DocContent');
    }

    public function view(AuthUser $authUser, DocContent $docContent): bool
    {
        return $authUser->can('View:DocContent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DocContent');
    }

    public function update(AuthUser $authUser, DocContent $docContent): bool
    {
        return $authUser->can('Update:DocContent');
    }

    public function delete(AuthUser $authUser, DocContent $docContent): bool
    {
        return $authUser->can('Delete:DocContent');
    }

    public function restore(AuthUser $authUser, DocContent $docContent): bool
    {
        return $authUser->can('Restore:DocContent');
    }

    public function forceDelete(AuthUser $authUser, DocContent $docContent): bool
    {
        return $authUser->can('ForceDelete:DocContent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DocContent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DocContent');
    }

    public function replicate(AuthUser $authUser, DocContent $docContent): bool
    {
        return $authUser->can('Replicate:DocContent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DocContent');
    }

}