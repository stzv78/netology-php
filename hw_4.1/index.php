<?php
require_once 'db.php';

$_POST['isbn']= isset($_POST['isbn']) ? filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_STRING) : '';
$_POST['name'] = isset($_POST['name']) ? filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) : '';
$_POST['author'] = isset($_POST['author']) ? filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING) : '';
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>Список книг</title>
</head>
<body>
<div class="form">
    <form method="POST" action="index.php">
        <input type="text" name="name" placeholder="Название книги" value="<?php echo $_POST['name'] ?>">
        <input type="text" name="author" placeholder="Автор книги" value="<?php echo $_POST['author'] ?>">
        <input type="text" name="isbn" placeholder="ISBN" value="<?php echo $_POST['isbn'] ?>">
        <input class="btn btn-primary" type="submit"  name="inquiry" value="Поиск">
    </form>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Название</th>
            <th>Автор</th>
            <th>Год выпуска</th>
            <th>ISBN</th>
            <th>Жанр</th>
        </tr>
    <?php
        $sqlInquiry = "(`isbn` LIKE :isbn) AND (`name` LIKE :name) AND (`author` LIKE :author)";
        $sql = "SELECT * FROM `books` WHERE " . $sqlInquiry;
        $books = $db ->prepare($sql);
        $books->execute(["isbn" => $_POST['isbn'] . "%","name" => $_POST['name'] ."%","author" => $_POST['name'] ."%"]);
        foreach ($books as $value) {
            echo "<tr><td>";
            echo strip_tags(htmlspecialchars($value["name"], ENT_QUOTES));
            echo "</td><td>";
            echo strip_tags(htmlspecialchars($value["author"], ENT_QUOTES));
            echo "</td><td>";
            echo strip_tags(htmlspecialchars($value["year"], ENT_QUOTES));
            echo "</td><td>";
            echo strip_tags(htmlspecialchars($value["isbn"], ENT_QUOTES));
            echo "</td><td>";
            echo strip_tags(htmlspecialchars($value["genre"], ENT_QUOTES));
            echo "</td></tr>";
        }
    ?>
    </table>
</div>
</body>
</html>
