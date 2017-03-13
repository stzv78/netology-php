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
echo "</pre>";


//Формируем и выводим новый массив из названий животных, состоящих из двух слов (разделенных пробелом)
$i=0;
foreach ($myArray as $continent => $arrAnimals)
{
	foreach ($arrAnimals  as  $key => $value)
	{
		$pos = strpos($value," ");
		if ($pos)
		{
			$newArray[$i] = $value;
			$i++;
		}
	}
}

echo "<pre>"; 
print_r($newArray); 
echo "</pre>";

//Формируем новый массив из названий выдуманных животных, сохраняя регион обитания
$data = array(); 
$i=0; 
foreach ($myArray as $continent => $arrAnimals)
{
 	foreach ($arrAnimals  as  $key => $value)
		{
			if ($value == $newArray[$i])  
			{
				$random_index = rand(0, count($newArray) - 1); 
				$pos = strpos($value," ");

				$data[$continent][] = substr($value, 0, $pos) . substr($newArray[$random_index], strpos($newArray[$random_index]," "));
		    	$i++;
			}
		}
	}
//Вывод результата
foreach ($data as $continent => $arrAnimals)
{
 	echo '<h1>' . $continent . '</h1>';
 	echo implode(", ", $arrAnimals);
}
?>