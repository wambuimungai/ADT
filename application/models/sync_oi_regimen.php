<?php
class Sync_oi_regimen extends Doctrine_Record{
    public function setTableDefinition() {
        $this->hasColumn('oi_code', 'varchar', 20);
        $this->hasColumn('oi_description','varchar', 200);
        $this->hasColumn('category_id','int',11);
     
    }
    public function setUp() {
        $this->setTableName('sync_oi_regimen');
        $this -> hasOne('Sync_Regimen_Category as Sync_Regimen_Category', array('local' => 'category_id', 'foreign' => 'id'));
    }
    public function getAll() {
        $query= Doctrine_Query::create()->select("*")->from("sync_oi_regimen");
        $sync_ois= $query->execute(array(), Doctrine::HYDRATE_ARRAY);
        return $sync_ois;   
    }
    public function getActive() {
            $query = Doctrine_Query::create() -> select("sor.id,sor.oi_code,sor.oi_description,sor.category_id, sor.Sync_Regimen_Category.Name as category_name") -> from("sync_oi_regimen sor") -> orderBy("category_id, oi_code asc");
            $sync_ois = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
            return $sync_ois;
    }

    public function getId($regimen_code) {
            $query = Doctrine_Query::create() -> select("id") -> from("sync_oi_regimen") -> where("oi_code like '%$regimen_code%'");
            $sync_oi_regimen = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
            return @$sync_oi_regimen[0]['id'];
    }
}

