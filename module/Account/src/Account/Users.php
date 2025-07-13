<?php

namespace Account;

use Application\ConfigurationTableGateway;
use Application\Logs;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Users
{
    protected $_name = 'users'; //db name
    protected $_id = 'UserID'; //Primary Key
    protected $_order = array('UserID' => 'ASC');
    protected $select;
    protected $_db;
    protected $_log;

    public function __construct()
    {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        $this->_log = new Logs;
        return $this->_db;
    }

    public function input($input) {
        $data = array();
        if(isset($input['FirstName'])) { $data['FirstName'] = trim($input['FirstName']); }
        if(isset($input['LastName'])) { $data['LastName'] = trim($input['LastName']); }
        if(isset($input['Email'])) { $data['Email'] = trim($input['Email']); }
        if(isset($input['Password'])) { $data['Password'] = md5($input['Password']); }
        if(isset($input['ThemeID'])) { $data['ThemeID'] = trim($input['ThemeID']); }

        if (isset($input[$this->_id])) {
            $this->update($input[$this->_id], $data);
            return $input[$this->_id];
        } else {
            $memberid = $this->insert($data);
            return $memberid;
        }
    }

    private function insert($data) {
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $data['ThemeID'] = '1';

        $this->_log->logInsertItem($this->_name, $data);

        $this->_db->insert($data);
    }

    private function update($userid, $data) {
        $this->_log->logUpdateItem($this->_name, $userid, $data);

        $this->_db->update($data, array($this->_id => $userid));
    }

    private function delete($userid) {
        $this->_log->logDeleteItem($this->_name, $userid, $this->getDetails($userid));

        $this->_db->delete(array($this->_id => $userid));
    }

    public function getDetails($userid) {
        if (!empty($userid)) {
            $this->select->from($this->_name)->columns(array('UserID', 'FirstName', 'LastName', 'Email', 'ThemeID'));
            $where = new Where();
            $where->equalTo('UserID', $userid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function validate($data) {
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