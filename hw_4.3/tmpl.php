<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <style>
    .colorgraph {
            height: 5px;
            border-top: 0;
            background: #c4e17f;
            border-radius: 5px;
            background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
    </style>   
    <title>Список дел</title>   
</head>
<body>
<div class = "container">
<div class="col-xs-12">
<h1>Список всех дел:</h1>
<hr class="colorgraph"></hr>

    <?php if ($action === 'edit'): ?>
    <div class="form">
        <form method="POST" action="todo.php">
            <input class="field" type="text" name="description" value="<?php echo $description;?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="change" value="Изменить задачу">
        </form>
    </div>
    <?php else: ?>
    <div class="form">
        <form method="POST" action="todo.php">
            <input class="field" type="text" name="description" placeholder="Описание задачи" value="" required>
            <input type="submit" name="addTask" value="Добавить задачу">
        </form>
        <form method="POST" action="todo.php">
            <label for="order">Сортировать по:</label>
            <select class="form" name="order_by">
                <option value="date_added">Дате добавления</option>
                <option value="is_done">Статусу</option>
                <option value="description">Описанию</option>
            </select>
            <input type="submit" name="order" value="Отсортировать">
        </form>
    </div>
    <?php endif; ?>
    <hr></hr>

    <div class="form-group">
       
        <table class="table table-bordered table-striped">
            <tr>
                <th>Описание задачи</th>
                <th>Автор</th>
                <th>Дата добавления</th>
                <th>Исполнитель</th> 
                <th>Статус</th>
                <th>Действия</th>
                <th>Назначить пользователю:</th>
            </tr>
            <?php foreach ($tasks as $key => $value): ?>
                <tr>
                    <td><?php echo htmlspecialchars($value['description'], ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($value['author'], ENT_QUOTES); ?></td>
                    <td><?php echo $value['date_added']; ?></td>
                    <td><?php echo $value['assigned_user']; ?></td>
                 
                    <?php if ($value['is_done'] == true): ?>
                        <td style='color: green;'>Выполнено</td>
                        <td><a href="?id=<?php echo $value['id']; ?>&action=delete">Удалить</a></td>
                    <?php else: ?>
                        <td style='color: red;'>Не выполнено</td>
                        <td>
                        <a href="?id=<?php echo $value['id']; ?>&description=<?php echo $value['description']; ?>&action=edit">Изменить</a>
                        <a href="?id=<?php echo $value['id']; ?>&action=done">Выполнить</a>
                        <a href="?id=<?php echo $value['id']; ?>&action=delete">Удалить</a>
                    </td>
                    <?php endif; ?>
                    <td>

                    <form action="todo.php" method="POST">
                        <select class="form" name="assigned_user_id">
                        <?php displayUserList($users) ?>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                        <input name="assigned" type="submit" value="Назначить ответственным">
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
   
    <h1>Список моих дел:</h1>
    <hr class="colorgraph"></hr>
    <table class="table table-bordered table-striped">
            <tr>
                <th>Описание задачи</th>
                <th>Автор</th>
                <th>Дата добавления</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            <?php foreach ($myTasks as $key => $val): ?>
                <tr>
                    <td><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($val['author'], ENT_QUOTES); ?></td>
                    <td><?php echo $value['date_added']; ?></td>
                    <?php if ($value['is_done'] == true): ?>
                        <td style='color: green;'>Выполнено</td>
                        <td><a href="?id=<?php echo $val['id']; ?>&action=delete">Удалить</a></td>
                    <?php else: ?>
                        <td style='color: red;'>Не выполнено</td>
                        <td>
                        <a href="?id=<?php echo $val['id']; ?>&description=<?php echo $val['description']; ?>&action=edit">Изменить</a>
                        <a href="?id=<?php echo $val['id']; ?>&action=done">Выполнить</a>
                        <a href="?id=<?php echo $val['id']; ?>&action=delete">Удалить</a>
                    </td>
                    <?php endif; ?>
               </tr>
            <?php endforeach; ?>
        </table>

</div>

</div>
</body>
</html>