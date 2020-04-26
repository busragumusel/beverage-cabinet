<?php

require_once('BeverageCabinet.php');

$beverage =  new Beverage();
$beverage->setName('Coke');
$beverage->setCapacity(33);
$beverageCabinet = new BeverageCabinet($beverage);

echo 'Beverage Cabinet Capacity: ' . $beverageCabinet->getCapacity() . PHP_EOL;
echo 'Beverage Cabinet Capacity Status: ' . $beverageCabinet->getCabinetCapacityStatus() . PHP_EOL;
echo 'Beverage Count in Beverage Cabinet: ' . $beverageCabinet->getBeverageCount() . PHP_EOL;

$beverage->setName('Beer');
echo $beverageCabinet->addBeverage($beverage, 1) . PHP_EOL;
$beverage->setName('Coke');
echo $beverageCabinet->addBeverage($beverage, 1) . PHP_EOL;
$beverageCabinet->setDoorStatus(true);
if ($beverageCabinet->getDoorStatus()) {
    echo 'The door is opened.' . PHP_EOL;
}

if ($beverageCabinet->addBeverage($beverage, 1) === true) {
    echo  'The beverage is added.' . PHP_EOL;
}

echo 'Beverage Cabinet Capacity Status: ' . $beverageCabinet->getCabinetCapacityStatus() . PHP_EOL;
echo 'Beverage Count in Beverage Cabinet: ' . $beverageCabinet->getBeverageCount() . PHP_EOL;

if ($beverageCabinet->takeBeverage(1) === true) {
    echo  'The beverage is taken' . PHP_EOL;
}
echo $beverageCabinet->takeBeverage(2) . PHP_EOL;

for ($j=1; $j<=$beverageCabinet->getShelveCount(); $j++){
    for ($i=1; $i<=$beverageCabinet->getShelveCapacity(); $i++) {
        if ($beverageCabinet->addBeverage($beverage, $j) === true) {
            echo  'The beverage is added.' . PHP_EOL;
        }
    }
}
echo 'Beverage Cabinet Capacity Status: ' . $beverageCabinet->getCabinetCapacityStatus() . PHP_EOL;
echo 'Beverage Count in Beverage Cabinet: ' . $beverageCabinet->getBeverageCount() . PHP_EOL;

echo $beverageCabinet->addBeverage($beverage, 5) . PHP_EOL;
echo $beverageCabinet->addBeverage($beverage, 3) . PHP_EOL;

$beverageCabinet->setDoorStatus(false);
if (!$beverageCabinet->getDoorStatus()) {
    echo 'The door is closed.' . PHP_EOL;
}