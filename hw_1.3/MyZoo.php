<?php 
 
//Исходный многомерный массив 
$myArray = array (
	'Africa' => array('Rhinoceros','Agama agama','Alcelaphus caama',), 
	'North America' => array('Mammuthus columbi','Vulpes macrotis'), 
	'South America' => array('Echinoprocta rufescens','Vicugna pacos', 'Archelon ischyros'),
	'Eurasia' => array('Moschus','Meles canescens','Felis margarita','Marmota bobak'),
	'Australia' => array('Crocodylus johnstoni','Australobarbarus'), 
	'Antarctica' => array('Catharacta antarctica','Leptonychotes weddellii','Ursus maritimus'));

echo "<pre>"; 
print_r($myArray); 

$b = array();

//Формируем новый массив.Он будет состоять из названий животных в два слова
foreach ($myArray as $continent => $arrAnimals)
{
	foreach ($arrAnimals  as  $key => $value)
	{   
		$tmp = explode(" ", $value);
		echo $value;
		if (count($tmp) !==2 )
		{
			unset($myArray[$continent][$key]);
		} else {
			$myArray[$continent][$key] = $tmp['0'];
			$b[] = $tmp['1'];
		}
    }
}
//перемешали вторые слова
print_r($myArray);
shuffle($b);
print_r($b);
echo "</pre>";

//Формируем новый массив из названий выдуманных животных, сохраняя регион обитания
foreach ($myArray as $continent => $arrAnimals)
{
 	foreach ($arrAnimals  as  $key => $value)
	{   
		$myArray[$continent][$key] = "$value " . array_shift($b);
    }
}

//Вывод результата
foreach ($myArray as $continent => $arrAnimals)
{
 	echo '<h1>' . $continent . '</h1>';
 	echo implode(", ", $arrAnimals);
}
?>