<?php namespace Account;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Application\Logs;

class Themes {
    protected $_name = 'themes'; // Table name
    protected $_id = 'ThemeID'; // Primary key
    protected $_order = array('ThemeID' => 'ASC'); // Sort order
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
    public function Details($themeid) {
        if (!empty($themeid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('ThemeID', $themeid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    // Get details of all records
    public function All() {
        $this->select->from($this->_name)->order(array('ThemeID' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }
}