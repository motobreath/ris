<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;

class UserTable
{
    protected $sql;
    
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway, Sql $sql)
    {
        $this->sql = $sql;
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
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
    
    public function getAdmins(){
        $select = $this->sql->select();
        $select->from('users')
               ->join('roles', 'users.id = roles.userid')
               ->where->equalTo('roles.role', 'admin');
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        
        return $result;
    }

    public function save(User $user)
    {
        $data = array(
            'ucmnetid' => $user->ucmnetid,
            'name'  => $user->name,
        );

        $id = (int)$user->id;
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
        return $this->tableGateway->delete(array('id' => $id));
    }
}

?>
