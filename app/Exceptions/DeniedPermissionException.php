<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-05-30
 * Time: 23:45
 */

namespace App\Exceptions;

use App\Permission;
use Exception;

class DeniedPermissionException extends Exception
{
    private $permission;
    public function __construct(Permission $permission, Exception $previous = null)
    {
        $this -> setPermission($permission);
        parent::__construct('缺少 ' . $permission -> display_name . ' 权限', 1, $previous);
    }

    /**
     * @param mixed $permission
     * @return DeniedPermissionException
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }
}