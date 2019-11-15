<?php
    session_start();
    include ("connect.php");
    include ("database.php");
    // try {
    //     $db = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
    // }
    // catch (exception $e)
    // {
    //     echo "An error has occured";
    // }
    // $db->exec("CREATE DATABASE IF NOT EXISTS camagru_users");
    // $db->exec("CREATE TABLE IF NOT EXISTS camagru_users.users (ID INT AUTO_INCREMENT, Username VARCHAR(255), Password VARCHAR(255), Email VARCHAR(255), Token TEXT(8), Status VARCHAR(10), Connection VARCHAR(20), PRIMARY KEY(ID))");
    try 
	{
		$conn = new PDO($DB_SERVER, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
		$conn->exec($sql);
		echo "Database created successfully<br/>";
		$sql = "USE $DB_NAME;";
        $conn->exec($sql);
        
		$sql = "CREATE TABLE IF NOT EXISTS users 
		(
			ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			Username VARCHAR(255) UNIQUE NOT NULL,
			Password TEXT NOT NULL,
			Email VARCHAR(255) UNIQUE NOT NULL,
			Token VARCHAR(255) UNIQUE NOT NULL,
			Status VARCHAR(10)  NOT NULL	
		)";
		$conn->exec($sql);
        echo "The users table was successfully created<br/>";
        
        
		$sql = "CREATE TABLE IF NOT EXISTS images 
		(
			image_id INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			user_id INT(255) NOT NULL,
			FOREIGN KEY (user_id) REFERENCES users(user_id), 
			image LONGTEXT CHARACTER SET utf8 NOT NULL,
			date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL	
		)";
		$conn->exec($sql);
		echo "The images table was successfully created<br/>";

		
		$sql = "CREATE TABLE IF NOT EXISTS comments
		(
			Comment TEXT NOT NULL,
			Username INT(255) NOT NULL,
			FOREIGN KEY (Username) REFERENCES users(Username),
			Image VARCHAR(255) NOT NULL
		)";
		$conn->exec($sql);
		echo "The comments table was successfully created<br/>";


		$sql = "CREATE TABLE IF NOT EXISTS likes
		(
			Username INT(255) NOT NULL,
			FOREIGN KEY (Username) REFERENCES users(Username),
			Image VARCHAR(255) NOT NULL
		)";
		$conn->exec($sql);
		echo "The likes table was successfully created<br/>";
}
catch(PDOException $e){
	echo $sql . "<br>" . $e->getMessage();
}
?>