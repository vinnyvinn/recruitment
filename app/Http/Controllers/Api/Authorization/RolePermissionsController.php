<?php

namespace Boaz\Http\Controllers\Api\Authorization;

use Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Boaz\Events\Role\PermissionsUpdated;
use Boaz\Http\Controllers\Api\ApiController;
use Boaz\Http\Requests\Role\CreateRoleRequest;
use Boaz\Http\Requests\Role\RemoveRoleRequest;
use Boaz\Http\Requests\Role\UpdateRolePermissionsRequest;
use Boaz\Http\Requests\Role\UpdateRoleRequest;
use Boaz\Repositories\Role\RoleRepository;
use Boaz\Repositories\User\UserRepository;
use Boaz\Role;
use Boaz\Transformers\PermissionTransformer;
use Boaz\Transformers\RoleTransformer;

/**
 * Class RolePermissionsController
 * @package Boaz\Http\Controllers\Api
 */
class RolePermissionsController extends ApiController
{
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
        $this->middleware('auth');
        $this->middleware('permission:permissions.manage');
    }

    public function show(Role $role)
    {
        return $this->respondWithCollection(
            $role->cachedPermissions(),
            new PermissionTransformer
        );
    }

    /**
     * Update specified role.
     * @param Role $role
     * @param UpdateRolePermissionsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Role $role, UpdateRolePermissionsRequest $request)
    {
        $this->roles->updatePermissions(
            $role->id,
            $request->permissions
        );

        event(new PermissionsUpdated);

        return $this->respondWithCollection(
            $role->cachedPermissions(),
            new PermissionTransformer
        );
    }
}
