<?php
class Oi_regimen extends Doctrine_Record{
    public function setTableDefinition() {
        $this->hasColumn('oi_code', 'varchar', 20);
        $this->hasColumn('oi_description','varchar', 200);
        $this->hasColumn('category','int',11);
    }
    public function setUp() {
        $this->setTableName('oi_regimen');
        $this -> hasOne('Regimen_Category as Regimen_Category', array('local' => 'Category', 'foreign' => 'id'));
    }
    public function getAll() {
        $query= Doctrine_Query::create()->select("*")->from("oi_regimen");
        $ois= $query->execute(array(), Doctrine::HYDRATE_ARRAY);
        return $ois;   
    }
      public function getAllHydrated(){
       $query = Doctrine_Query::create() -> select("or.oi_Code, or.oi_description,rc.Name as Regimen_Category") -> from("Oi_regimen or") -> leftJoin('or.Regimen_Category rc') -> orderBy("or.id desc");
       $ois = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
       return $ois;
    }
}

