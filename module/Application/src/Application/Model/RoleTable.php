<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class RoleTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(array $params)
    {
        $resultSet = $this->tableGateway->select($params);
        return $resultSet;
    }

    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function find(array $params){
        $rowset = $this->tableGateway->select($params);
        $row = $rowset->current();
        return $row;
    }

    public function save(Role $role)
    {
        $data = array(
            'userID' => $role->userID,
            'role'  => $role->role,
        );

        $id = (int)$role->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->getLastInsertValue();
        } else {
            if ($this->get($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
        return $id;
    }

    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}

?>
