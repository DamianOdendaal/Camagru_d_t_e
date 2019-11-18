<?php
    session_start();
    include ("connect.php");
	
    try 
	{
		$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
		$conn->exec($sql);
		echo "Database created successfully<br/>";
		$sql = "USE $DB_NAME;";
        $conn->exec($sql);
        
		// $sql = "CREATE TABLE IF NOT EXISTS users 
		// (
		// 	ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL,
		// 	Username VARCHAR(255) NOT NULL,
		// 	Password TEXT NOT NULL,
		// 	Email VARCHAR(255) UNIQUE NOT NULL,
		// 	Token VARCHAR(255) UNIQUE NOT NULL,
		// 	Status VARCHAR(10)  NOT NULL	
		// )";
		$sql = "CREATE TABLE IF NOT EXISTS `users` (
			`ID` int(255) NOT NULL,
			`Username` varchar(255) NOT NULL,
			`Password` text NOT NULL,
			`Email` varchar(255) NOT NULL,
			`Token` varchar(255) NOT NULL,
			`Status` varchar(10) NOT NULL
		  )"; 
		$conn->exec($sql);
        echo "The users table was successfully created<br/>";
        
        
		$sql = "CREATE TABLE IF NOT EXISTS images 
		(
			ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			Username VARCHAR(255) NOT NULL
		)";
		$conn->exec($sql);
		echo "The images table was successfully created<br/>";

		
		$sql = "CREATE TABLE IF NOT EXISTS comments
		(
			Comment TEXT NOT NULL,
			Username VARCHAR(255) NOT NULL,
			Image VARCHAR(255) NOT NULL
		)";
		$conn->exec($sql);
		echo "The comments table was successfully created<br/>";


		$sql = "CREATE TABLE IF NOT EXISTS likes
		(
			Username VARCHAR(255) NOT NULL,
			Image VARCHAR(255) NOT NULL
		)";
		$conn->exec($sql);
		echo "The likes table was successfully created<br/>";
}
catch(PDOException $e){
	echo $sql . "<br>" . $e->getMessage();
}
?>