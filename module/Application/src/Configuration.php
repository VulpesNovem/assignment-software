<?php


namespace Application;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Delete;


class Configuration
{

    protected $_name = 'configurations';  //table name
    protected $_id  = 'ConfigurationID'; //key field name
    protected $_db;
    public function __construct() {
        $this->_db = new ConfigurationTableGateway($this->_name);
        return $this->_db;
    }

    public function getCode($code="") {
        $rowset = $this->_db->select(array('ConfigurationKey' => $code));
        $result = $rowset->current();
        return $result['ConfigurationValue'];
    }

    public function getConfigs() {
        $rowset = $this->_db->select();
        $result = $rowset->toArray();
        $list = array();
        foreach($result AS $row){
            $list[$row['ConfigurationKey']] = $row['ConfigurationValue'];
        }
        return $list;
    }

    public function getValue($code=""){

        $rowset = $this->_db->select(array('ConfigurationKey' => $code));
        $result = $rowset->current();
        if (!$result) {return;}
        return $result['ConfigurationValue'];


    }
}