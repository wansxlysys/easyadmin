<?php


namespace app\index\repository;


use think\Db;
use think\exception\DbException;

use app\common\repository\Repository;

class UserRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_manager';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'managerId';

    /**
     * 查询用户信息
     * @throws DbException
     */
    public function selectWithInfo(array $params = [])
    {
        $db = Db::name($this->name);

        $db->alias('manager');
        $db->join('system_manager_role role', 'role.roleId = manager.roleId');

        if (!empty($params['departmentId'])) {
            $db->join('system_department department', 'department.departmentId = manager.departmentId');
        }

        if (!empty($params['oper'])) {
            $db->join(Db::name('system_oper_log')->group('logId')->buildSql() . ' oper', 'oper.managerId = manager.managerId');
        }

        if (!empty($params['log'])) {
            $db->where('logId', 'in', function ($query) {
                $query->table('system_login_log')->field('id');
            });
        }

        if (!empty($params['account'])) {
            $db->where('account', 'like', '%' . $params['name'] . '%');
        }

        $db->field('distinct manager.*, role.roleName, department.departmentName, oper.*, log.*');

        return $db->buildSql(false);
    }
}