<?php 
ini_set('display_errors', true);
ini_set('html_errors', true);

class ModelCar {
	function __construct($id, $category, $name, $vendorId, $vendorName) {
		$this->id = $id;
        $this->category = $category;
		$this->name = $name;
        $this->vendorId = $vendorId;
        $this->vendorName = $vendorName;
	}
}

class ModelCarsCollection {
	function __construct($modelCars) {
		$this->modelCars = $modelCars;
	}
}

function getModelCars() {

    $ford = new ModelCar(1, 'Trucks and Buses', '1940 Ford Pickup Truck', 1, 'Motor City Art Classics');
    $chevy = new ModelCar(2, 'Trucks and Buses', '1957 Chevy Pickup', 2, 'Gearbox Collectibles');
    $alfa = new ModelCar(3, 'Classic Cars', '1972 Alfa Romeo GTA', 1, 'Motor City Art Classics');
    $harley = new ModelCar(4, 'Motorcycles', '2003 Harley-Davidson Eagle Drag Bike', 4, 'Studio M Art Models');
    $guzzi = new ModelCar(5, 'Motorcycles', '1996 Moto Guzzi 1100i', 1, 'Motor City Art Classics');
    $renault = new ModelCar(6, 'Classic Cars', '1952 Alpine Renault 1300', 4, 'Studio M Art Models');
    $mazda = new ModelCar(7, 'Classic Cars', '1993 Mazda RX-7', 1, 'Motor City Art Classics');
    $aston = new ModelCar(8, 'Classic Cars', '1965 Aston Martin DB5', 1, 'Motor City Art Classics');
    $chrysler = new ModelCar(9, 'Classic Cars', '1998 Chrysler Plymouth Prowler', 3, 'Unimax Art Galleries');
    $fireEngine = new ModelCar(10, 'Trucks and Buses', '1926 Ford Fire Engine', 4, 'Studio M Art Models');

    $collection = new ModelCarsCollection(array($ford,$chevy,$alfa,$harley,$guzzi,$renault, $mazda, $aston, $chrysler, $fireEngine));

    // TODO: Replace lines above with database call.
    
    return $collection;
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'];
$requestBody = file_get_contents('php://input');
$result = '';

switch ($method) {
    
	case 'GET':
    
		$result = getModelCars();
		header('Cache-Control: no-cache, must-revalidate');
		header('content-type:application/json');
		echo(json_encode($result));
		break;

	case 'POST':
    
		switch ($action) {
    
			case 'create':
            
				$modelCar = json_decode($requestBody);
				// TODO: Save $modelCar in the database.
            
				$result = array('success' => true, 'action' => 'create', 'modelCar' => $modelCar);
				header('Cache-Control: no-cache, must-revalidate');
				header('content-type:application/json');
				echo(json_encode($result));
    
			break;
    
			case 'update':
        
				$updatedData = json_decode($requestBody);
				// TODO: Save $updatedData in the database.
            
				$result = array('success' => true, 'action' => 'update', 'updatedData' => $updatedData);
				header('Cache-Control: no-cache, must-revalidate');
				header('content-type:application/json');
				echo(json_encode($result));
    
			break;
        
			case 'destroy':
        
				$deletedData = json_decode($requestBody);
				// TODO: Delete $deletedData from the database.
            
				$result = array('success' => true, 'action' => 'destroy', 'deletedData' => $deletedData);
				header('Cache-Control: no-cache, must-revalidate');
				header('content-type:application/json');
				echo(json_encode($result));
        
			break;
    
		}
    
    break;
}




?>
