<?php
class Cd4_Lab_Commodity_Categories extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('name','varchar', 50);
	}
 	public function setUp() {
		$this -> setTableName('cd4_lab_commodity_categories');
		$this -> hasMany('cd4_commodities as commodities', array('local' => 'id', 'foreign' => 'category'));
	}
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("cd4_lab_commodity_categories") -> orderBy("id");
		$categories = $query -> execute();
		return $categories;
	}
	public static function get_active() {
			$query = Doctrine_Query::create() -> select("*") -> from("cd4_lab_commodity_categories") ->where("active='1'")-> orderBy("id");
			$categories = $query -> execute();
			return $categories;
	}
 

}
?>