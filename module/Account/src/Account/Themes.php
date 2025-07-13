<?php

namespace Account;

use Application\Logs;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Themes
{
    protected $_name = 'themes'; //db name
    protected $_id = 'ThemeID'; //Primary Key
    protected $_order = array('ThemeID' => 'ASC');
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

    public function getDetails($themeid)
    {
        if (!empty($themeid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('ThemeID', $themeid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll()
    {
        $this->select->from($this->_name)->order(array('ThemeID' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }
}