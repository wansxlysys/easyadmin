<?php


namespace app\common\repository;


use think\Exception;

class Repository extends Dao
{
    /**
     * 通过ID获取
     * @param $id
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getById($id, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->addWhere('id', '=', $id);

        return $this->getOne($Wrapper);
    }

    /**
     * 通过条件查询
     * @param array $where
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getByWhere(array $where, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->setWhere($where);

        return $this->getOne($Wrapper);
    }

    /**
     * ID查询全部
     * @param $id
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getAllById($id, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->addWhere('id', 'in', $id);

        return $this->getAll($Wrapper);
    }

    /**
     * 条件查询全部
     * @param array $where
     * @param array $field
     * @return mixed
     * @throws Exception
     */
    public function getAllByWhere(array $where, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->setWhere($where);

        return $this->getAll($Wrapper);
    }

    /**
     * 通过ID更新
     * @param $id
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateById($id, array $data)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('id', 'in', $id);

        return $this->updateRecord($Wrapper, $data);
    }

    /**
     * 通过条件更新
     * @param array $where
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateByWhere(array $where, array $data)
    {
        $Wrapper = new Wrapper();

        $Wrapper->setWhere($where);

        return $this->updateRecord($Wrapper, $data);
    }

    /**
     * 通过ID删除
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteById($id)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('id', 'in', $id);

        return $this->deleteRecord($Wrapper);
    }

    /**
     * 条件删除
     * @param array $where
     * @return int
     * @throws Exception
     */
    public function deleteByWhere(array $where)
    {
        $Wrapper = new Wrapper();

        $Wrapper->setWhere($where);

        return $this->deleteRecord($Wrapper);
    }
}