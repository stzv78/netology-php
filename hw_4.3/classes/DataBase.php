<?php
class DataBase
{
	private static $db = NULL;
	private $connection;
	
	public static function getDb()
	{
		if (self :: $db == NULL)
		{
			self :: $db = new DataBase();
		}
		return self :: $db;
	}

	public function __construct()
	{
		try {
			    $config = require_once 'config.php';
                $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbName'].';charset='.$config['charset'];
           	    $this->connection = new PDO($dsn, $config['userName'], $config['userPassword']);
		} catch (PDOException $e) {
	        //нет соединения c БД
	        echo "Database connection failed!";
            exit;
	    }
    }

     
    //ищет id пользователя по логину-паролю в БД
    public function selectUser($login, $password)
    { 
        $sql = "SELECT login, password, id FROM `user` WHERE login LIKE :login";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":login", $login, PDO::PARAM_INT);
        $st->execute();             
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    //выбирает все данные из таблиц
    public function selectAllData($table, $order)
    {   
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM `". $table . "` ORDER BY " . $order;
        $st = $this->connection->prepare($sql);
        $st->execute();
        return  $st->fetchALL(PDO::FETCH_ASSOC);
    }

    public function insertData($description, $user_id)
    {   
    	$date_added = date('Y-m-d H:i:s');
    	$sql = "INSERT INTO `task` (`description`,`user_id`,`date_added`) VALUES (:description, :user_id, :date_added)";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":description", $description, PDO::PARAM_INT);
        $st->bindValue( ":user_id", $user_id, PDO::PARAM_INT);
        $st->bindValue( ":date_added", $date_added, PDO::PARAM_INT);
        $st->execute();
    }

    public function insertUser($log, $pass)
    {   
        $sql = "INSERT INTO `user` (`login`,`password`) VALUES (:login, :password)";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":login", $log, PDO::PARAM_INT);
        $st->bindValue( ":password", $pass, PDO::PARAM_INT);
        $st->execute();
    }
    
    //выбирает все задачи пользователей из БД
    public function selectUsersTasks($order)
    { 
        $sql = "SELECT t.id, t.assigned_user_id, t.user_id, t.date_added, t.is_done, t.description, u.login
                      FROM task t
                      INNER JOIN user u ON  u.id = t.user_id
                      ORDER BY t." . $order;
        $st = $this->connection->prepare($sql);
        $st->execute();          
        return  $st->fetchALL(PDO::FETCH_ASSOC);
    }

    
    //выбирает все задачи, назначенные пользователю 
    public function selectMyTasks($id, $order)
    { 
        $sql = "SELECT t.id, t.user_id, t.assigned_user_id, t.date_added, t.is_done, t.description, u.login
                      FROM task t
                      INNER JOIN user u ON  u.id = t.assigned_user_id
                      WHERE t.assigned_user_id LIKE :id  ORDER BY t." . $order;
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":id", $id, PDO::PARAM_INT);
        $st->execute();          
        return  $st->fetchALL(PDO::FETCH_ASSOC);
    }

    public function setAssignedUserId($id, $assigned_user_id)
    {   
        $sql = "UPDATE `task` SET `assigned_user_id` = :assigned_user_id WHERE `id` LIKE :id";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":assigned_user_id", $assigned_user_id, PDO::PARAM_INT );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
    }

    public function deleteData($id)
    {   
    	$sql = "DELETE FROM `task` WHERE id = :id LIMIT 1";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":id", $id, PDO::PARAM_INT);
        $st->execute();
    }
    
    public function markData($id)
    {   
    	$sql = "UPDATE `task` SET `is_done` = :is_done WHERE `id` LIKE :id";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":is_done", 1, PDO::PARAM_INT );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
    }

    public function editData($id, $description)
    {   
    	$sql = "UPDATE `task` SET `description` = :description WHERE `id` LIKE :id";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":description", $description, PDO::PARAM_INT );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
    }

}
