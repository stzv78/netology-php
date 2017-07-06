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


$array = array();
$b = array();

//Формируем новый массив.Он будет состоять из названий животных в два слова
foreach ($myArray as $continent => $arrAnimals)
{
	foreach ($arrAnimals  as  $key => $value)
	{
		if (str_word_count($value) === 2)
		{    
			$tmp = explode(" ", $value); //разбили по словам
			$b[] = array_pop($tmp); //извлекли второе слово
			$array[$continent][] = $tmp; //сохранили первое слово
 	    }
    }
    
}
//перемешали вторые слова
shuffle($b);
print_r($b);
echo "</pre>";

//Формируем новый массив из названий выдуманных животных, сохраняя регион обитания
foreach ($array as $continent => $arrAnimals)
{
 	foreach ($arrAnimals  as  $key => $value)
	{   
		$value[] = array_shift($b); //добавили второе слово в массив
		$array[$continent][$key] = implode(' ', $value);
    }
}

//Вывод результата
foreach ($array as $continent => $arrAnimals)
{
 	echo '<h1>' . $continent . '</h1>';
 	echo implode(", ", $arrAnimals);
}
?>