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

    public function input($input) {
        $data = array();
        if(isset($input['UserID'])) { $data['UserID'] = trim($input['UserID']); }
        if(isset($input['FirstName'])) { $data['FirstName'] = trim($input['FirstName']); }
        if(isset($input['LastName'])) { $data['LastName'] = trim($input['LastName']); }
        if(isset($input['Email'])) { $data['Email'] = trim($input['Email']); }
        if(isset($input['Password'])) { $data['Password'] = md5($input['Password']); }
        if(isset($input['ThemeID'])) { $data['ThemeID'] = trim($input['ThemeID']); }

//        die(print_r($data));
        if (isset($input[$this->_id])) {
            //If the inputted data has a CourseID
            $this->update($input[$this->_id], $data);
            return $input[$this->_id];
        } else {
            $memberid = $this->insert($data);
            return $memberid;
        }
    }

    private function insert($data) {
        $data['EntryDate'] = date('Y-m-d');
        $data['ThemeID'] = '1';
        return $this->_db->insert($data);
    }

    private function update($courseid, $data) {
        $this->_db->update($data, array($this->_id => $courseid));
        return;
    }

    private function delete($courseid) {
        $this->_db->delete(array($this->_id => $courseid));
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