<?php

namespace Application;

use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Logs
{
    protected $_name = 'logs'; //db name
    protected $_id = 'LogID'; //Primary Key
    protected $_order = array('Log' => 'ASC');
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
        if(isset($input['LogType'])) { $data['LogType'] = trim($input['LogType']); }
        if(isset($input['LogDetails'])) { $data['LogDetails'] = trim($input['LogDetails']); }

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
        $data['UserID'] = $_SESSION['AssignmentSession']['User'][0]['UserID'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $data['IPAddress'] = $ip;

        return $this->_db->insert($data);
    }

    private function update($logid, $data) {
        $this->_db->update($data, array($this->_id => $logid));
        return;
    }

    private function delete($logid) {
        $this->_db->delete(array($this->_id => $logid));
    }

    public function getDetails($logid) {
        if (!empty($logid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('LogID', $logid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function logInsertItem($tablename, $data) {
        $logdetails = [];
        $logdetails['LogType'] = "Insert";
        $logdetails['LogDetails'] = "Inserted new item in ".$tablename." with data: ".json_encode($data);
        return $this->input($logdetails);
    }

    public function logUpdateItem($tablename, $updateitemid, $data) {
        $logdetails = [];
        $logdetails['LogType'] = "Update";
        $logdetails['LogDetails'] = "Updated item ".$updateitemid." in ".$tablename." with data: ".json_encode($data);
        return $this->input($logdetails);
    }

    public function logDeleteItem($tablename, $deleteitemid, $data) {
        $logdetails = [];
        $logdetails['LogType'] = "Delete";
        $logdetails['LogDetails'] = "Deleted key ".$deleteitemid." from ".$tablename." with data: ".json_encode($data);
        return $this->input($logdetails);
    }

    public function logLogin($userid, $data) {
        $logdetails = [];
        $logdetails['LogType'] = "Login";
        $logdetails['LogDetails'] = "Login to account ".$userid." with data: ".json_encode($data);
        return $this->input($logdetails);
    }
}