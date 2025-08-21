<?php namespace Account;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Application\Logs;

class Users {
    protected $_name = 'users'; // Table name
    protected $_id = 'UserID'; // Primary key
    protected $_order = array('UserID' => 'ASC'); // Sort order
    protected $select;
    protected $_db;
    protected $_log;

    public function __construct() {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        $this->_log = new Logs;
        return $this->_db;
    }

    // Get details of a record
    public function Details($userid) {
        if (!empty($userid)) {
            $this->select->from($this->_name)->columns(array('UserID', 'DisplayName', 'FirstName', 'LastName', 'Email', 'ThemeID', 'Connections'));
            $where = new Where();
            $where->equalTo('UserID', $userid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    // Input data
    public function Input($input) {
        $data = array();
        if (isset($input['DisplayName'])) { $data['DisplayName'] = trim($input['DisplayName']); }
        if (isset($input['FirstName'])) { $data['FirstName'] = trim($input['FirstName']); }
        if (isset($input['LastName'])) { $data['LastName'] = trim($input['LastName']); }
        if (isset($input['Email'])) { $data['Email'] = trim($input['Email']); }
        if (isset($input['Password'])) { $data['Password'] = md5($input['Password']); }
        if (isset($input['ThemeID'])) { $data['ThemeID'] = trim($input['ThemeID']); }
        if (isset($input['Active'])) { $data['Active'] = trim($input['Active']); }
        if (isset($input['Admin'])) { $data['Admin'] = trim($input['Admin']); }

        if (isset($input[$this->_id])) {
            $this->Update($input[$this->_id], $data);
            return $input[$this->_id];
        } else {
            $memberid = $this->Insert($data);
            return $memberid;
        }
    }

    // Insert a new record
    private function Insert($data) {
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $data['ThemeID'] = '1';
        $data['Active'] = '1';
        $data['Admin'] = '0';

        $this->_log->LogInsert($this->_name, $data);

        $this->_db->insert($data);
    }

    // Update an existing record
    private function Update($userid, $data) {
        $this->_log->LogUpdate($this->_name, $userid, $data);

        $this->_db->update($data, array($this->_id => $userid));
    }

    // Remove an existing record
    private function Delete($userid) {
        $this->_log->LogDelete($this->_name, $userid, $this->Details($userid));

        $this->_db->delete(array($this->_id => $userid));
    }

    // Validate login information
    public function Validate($data) {
        $this->select->from($this->_name)->columns(array('UserID'));
        $where = new Where();
        $where->equalTo('Email', $data['Email'])->equalTo('Password', md5($data['Password']))->equalTo('users.Active', '1');
        $result = $this->_db->selectWith($this->select->where($where))->current();

        if (empty($result['UserID'])) {
            return false;
        } else {
            return $this->Details($result['UserID']);
        }
    }
}