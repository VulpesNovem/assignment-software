<?php

namespace Application;

use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Users
{
    protected $_name = 'users'; //db name
    protected $_id = 'UserID'; //Primary Key
    protected $_order = array('UserID' => 'ASC');
    protected $select;
    protected $_db;

    public function __construct()
    {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        return $this->_db;
    }

    public function getDetails($id)
    {
        if (!empty($id)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('UserID', $id);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function validate($data)
    {
        $this->select->from($this->_name)->columns(array('UserID'));
        $where = new Where();
        $where->equalTo('Email', $data['Email'])->equalTo('Password', md5($data['Password']))->equalTo('users.Active', '1');
        $result = $this->_db->selectWith($this->select->where($where))->current();
        if (empty($result['UserID'])) {
            return false;
        } else {
            return $this->getDetails($result['UserID']);
        }
    }
}