<?php
namespace Application;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\TableGateway\Feature;

class ConfigurationTableGateway extends AbstractTableGateway
{

    public function canCallMagicGet($property)
    {
        if ($property == 'metadata'){
            $result = $this->getMetadataFeature();
            return ($result!==FALSE);
        }
        else return parent::canCallMagicGet($property);
    }


    public function __construct($table)
    {
        $this->table = $table;
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->initialize();
    }
}