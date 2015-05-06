<?php
class Oi_regimen extends Doctrine_Record{
    public function setTableDefinition() {
        $this->hasColumn('oi_code', 'varchar', 20);
        $this->hasColumn('oi_description','varchar', 200);
     
    }
    public function setUp() {
        $this->setTableName('oi_regimen');
    }
    public function getAll() {
        $query= Doctrine_Query::create()->select("*")->from("oi_regimen");
        $ois= $query->execute(array(), Doctrine::HYDRATE_ARRAY);
        return $ois;   
    }
      public function getAllHydrated(){
        $query= Doctrine_Query::create()->select("oi_code,oi_description")->from("oi_regimen")->groupBy("oi_code");
        $ois=$query->execute(array(), Doctrine::HYDRATE_ARRAY);
        return $ois;
    }
}

