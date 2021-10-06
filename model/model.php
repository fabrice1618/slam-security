<?php
declare(strict_types = 1);
class Model
{
    private $table_definition = null;
    private String $dbh;

    protected $data = [];

    public function __construct( $aTableDefinition ) :
    {
        $this->table_definition = $this->cleanTableDefinition($aTableDefinition);

        $this->setDefault();

        $this->dbh = Database::connexion();
    }

    public function setDefault()
    {
        foreach ($this->table_definition as $sNomChamp => $aChamp) {
            $this->data[$sNomChamp] = $aChamp['default'];
        }
    }

 

    public function validate( $name, $value )
    {
//        var_dump($this->table_definition);
        $ValidFunction = $this->table_definition[$name]['valid'];
        $lValid = $ValidFunction($value);

        return($lValid);
    }

    public function toArray()
    {
        return($this->data);
    }

    public function toString()
    {
        return(json_encode($this->data));
    }

    protected function cleanTableDefinition($aInput)
    {

        if ( ! is_array($aInput) || count($aInput) == 0 ) {
            throw new \Exception(__CLASS__.": table definition incorrecte", 1);
        }

        $aTableDefinition = array();

        foreach ($aInput as $sChamp => $aParameters) {
            
            if ( isset($aParameters['valid']) && is_string($aParameters['valid']) && !empty($aParameters['valid']) ) {
                $aParameters['valid'] === $aParameters['valid'];
            } else {
                $aParameters['valid'] = "Valid::alwaysTrue";
            }

            $aParameters['default'] = $aParameters['default'] ?? null;

            if ( !isset($aParameters['pdo_type']) ) {
                $aParameters['pdo_type'] = PDO::PARAM_STR;
            }

            // Parametres normalisés
            $aTableDefinition[$sChamp] = $aParameters;                
        }

        return($aTableDefinition);
    }

}