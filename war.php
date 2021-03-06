<?php
// Свойства: жизни, броня, урон
abstract class Unit {
    private $health;
    private $armour;
    private $damage;

    public function __construct(int $health, int $armour, int $damage)
    {
        $this->health= $health;
        $this->armour = $armour;
        $this->damage = $damage;
    }
}
// Войска: пехота, конница, лучники.
abstract class Ryad extends Unit{
    public function __construct(Array $properties=array()){
    foreach($properties as $key => $value){
      $this->{$key} = $value;
    }
  }
}

$pehota = [
    'health' => 100,
    'armour' => 10,
    'damage' => 10,
];

$luchniki = [
    'health' => 100,
    'armour' => 5,
    'damage' => 20,
];

$konnica = [
    'health' => 300,
    'armour' => 30,
    'damage' => 30,
];
/*
$arrayobject1 = new ArrayObject($pehota);
$arrayobject2 = new ArrayObject($luchniki);
$arrayobject3 = new ArrayObject($konnica);*/

/*var_dump($arrayobject1);
var_dump($arrayobject2);
*/

// Создаём две армии (кол-во юнитов)
class Army extends Ryad {
    private string $name = '';
 
    public function __construct(string $name, Array $properties=array())
    {
        $this->name = $name;
        foreach($properties as $key => $value){
            
                $this->{$key} = $value;   
        }
    }
}

$army1 = [
    'name' => 'Александр Ярославич',
    'units' => [
        'pehota' => 200,
        'luchniki' => 30,
        'konnica' => 15,
    ]
];
$army2 = [
    'name' => 'Ульф Фасе',
    'units' => [
        'pehota' => 90,
        'luchniki' => 65,
        'konnica' => 25,
    ]
];

$object1 = new Army($army1['name'], $army1['units']);
$object2 = new Army($army2['name'], $army2['units']);

// Запускаем битву
function calc_army_damage_health($army)
{
    global $pehota, $luchniki, $konnica;

    $damage = 0;
    $health = 0;

    foreach ($army['units'] as $unit => $count) {
        $damage += ${$unit}['damage'] * $count;
        $health += ${$unit}['health'] * $count + ${$unit}['armour'] * $count;
    }

    return [$damage, $health];
};

list($damage1, $health1) = calc_army_damage_health($army1);
list($damage2, $health2) = calc_army_damage_health($army2);

//поочередные сражения всех типов войск
/*function every_line_damage($line1, $line2) {
    $result_of_line1 = 0;
    $result_of_line2 = 0;
    $damage_line1 = 0;
    $damage_line2 = 0;
    $health_line1 = 0;
    $health_line2 = 0;
    
        $damage_line1 += ${$line1}['damage'] * $count;
        $damage_line2 += ${$line2}['damage'] * $count;
        $health_line1 += ${$line1}['health'] * $count + ${$line1}['armour'] * $count;
        $health_line2 += ${$line2}['health'] * $count + ${$line2}['armour'] * $count;
        $result_of_line1 = $health_line1 - $damage_line1;
        $result_of_line2 = $health_line2 - $damage_line2;
    
    return [$result_of_line1, $result_of_line2];
}

list($every_line_pehota1,$every_line_pehota2) = every_line_damage($army1['pehota'], $army2['pehota']);
list($every_line_luchniki1,$every_line_luchniki2) = every_line_damage($army1['luchniki'], $army2['luchniki']);
list($every_line_konnica1,$every_line_konnica2) = every_line_damage($army1['konnica'], $army2['konnica']);
*/
/*
$duration = 0;
$result1 = $health1;
$result2 = $health2;
while($result1 > 0 && $result2 > 0) {
    $result1 -= $damage2;
    $result2 -= $damage1;
    $duration++;
}
*/

/*print_r($object2->luchniki);*/
?>


<table border="1">
    <tr>
        <th></th>
        <th><?=$army1['name']?></th>
        <th><?=$army2['name']?></th>
    </tr>
    <tr>
        <th>Damage:</th>
        <td><?=$damage1?></td>
        <td><?=$damage2?></td>
    </tr>
    <tr>
        <th>Vitals:</th>
        <td><?=$health1?></td>
        <td><?=$health2?></td>
        <th>Army units:</th>
        <td>pehota1 = <?=$every_line_pehota1?>, pehota2 = <?=$every_line_pehota2?></td>
        <td>luchniki1 = <?=$every_line_luchniki1?>, luchniki2 = <?=$luchniki2?></td>
        <td>konnica1 = <?=$every_line_konnica1?>, konnica2 = <?=$every_line_konnica2?></td>
    </tr>
<?php
$duration = 0;
while ($health1 >= 0 && $health2 >= 0) {
    $health1 -= $damage2;
    $health2 -= $damage1;
    $duration++;
}
?>
    <tr>
        <th>Health after <?=$duration?> hits:</th>
        <td><?=$health1?></td>
        <td><?=$health2?></td>
    </tr>
    <tr>
        <th>Result</th>
        <td><?=$health1 > $health2 ? 'WINNER' : 'LOOSER'?></td>
        <td><?=$health2 > $health1 ? 'WINNER' : 'LOOSER'?></td>
    </tr>
</table>