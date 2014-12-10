<?php 
ini_set("display_errors", true);
ini_set("html_errors", true);

class Vendor {
	function __construct($id, $name) {
		$this->id = $id;
        $this->name = $name;
	}
}

class VendorsCollection {
	function __construct($vendors) {
		$this->vendors = $vendors;
	}
}

$vendor1 = new Vendor(1, "Motor City Art Classics");
$vendor2 = new Vendor(2, "Gearbox Collectibles");
$vendor3 = new Vendor(3, "Unimax Art Galleries");
$vendor4 = new Vendor(4, "Studio M Art Models");

$collection = new VendorsCollection(array($vendor1,$vendor2,$vendor3,$vendor4));

header('Cache-Control: no-cache, must-revalidate');
header("content-type:application/json");

echo(json_encode($collection));


?>
