<?php
$json_data = file_get_contents('data.json');
$data = json_decode($json_data,true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Телефонная книга</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="danger">
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Адрес</th>
                <th>Телефон</th>
            </tr>
       </thead>

        <tbody>
        <?php 
            foreach($data as $person) 
            {
                echo "<tr>";
                echo "<td>" . $person['firstName'] . "</td>";
                echo "<td>" . $person['lastName'] . "</td>";
                echo "<td>" . $person['address'] . "</td>";
                echo "<td>" . $person['phoneNumber'] . "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
