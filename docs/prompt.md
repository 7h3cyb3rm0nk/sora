Project Path: /home/ramees/progs/php/sora

Source Tree:

```
sora
├── public
│   ├── images
│   │   └── sora-login.jpg
│   ├── css
│   │   ├── imports.css
│   │   └── styles.css
│   └── index.php
├── vendor
├── tests
│   └── sample.php
├── docs
│   ├── generate_code.sh
│   ├── js
│   │   ├── search.js
│   │   ├── template.js
│   │   └── searchIndex.js
│   ├── indices
│   │   └── files.html
│   ├── classes
│   │   └── User.html
│   ├── files
│   │   └── src-models-user.html
│   ├── namespaces
│   │   └── default.html
│   ├── index.html
│   ├── packages
│   │   ├── default.html
│   │   └── Application.html
│   ├── css
│   │   ├── normalize.css
│   │   ├── base.css
│   │   └── template.css
│   ├── reports
│   │   ├── markers.html
│   │   ├── errors.html
│   │   └── deprecated.html
│   └── graphs
│       └── classes.html
├── composer.lock
├── src
│   ├── views
│   │   └── sample.php
│   ├── models
│   │   ├── user.php
│   │   └── user.php.orig
│   ├── config
│   │   ├── database.php
│   │   ├── sample.php
│   │   ├── sora.sql
│   │   └── init.php
│   ├── controllers
│   │   └── sample.php
│   └── helpers
│       └── sample.php
├── composer.json
└── README.md

```

`/home/ramees/progs/php/sora/public/css/styles.css`:

```````css
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
```````

`/home/ramees/progs/php/sora/public/index.php`:

```````php
<?php 
require_once "../src/config/init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>SORA</title>
</head>
<body>
    <nav>SORA</nav>
    <section>
        <div>
        <form action="" class="login">
            <input type="text">
            <input type="text">
            <button>Log in</button>
        </form>
       </div>
       <div>
        <form action="" class="signup">
            <input type="text">
            <input type="text">
            <input type="email">
            <input type="passemail">
            <input type="password">
            <button>Sign up</button>
        </form>
       </div>

    </section>
</body>
</html>

```````

`/home/ramees/progs/php/sora/src/models/user.php`:

```````php
<?php                                                                                     
                                                                                      
/** User class for handling user-related operations                                       
*/                                                                                       
class User {  

		/** @var mysqli $db Database connection object */                                                  
	  private $db;    

		/**                                                                                     
		* Constructor for User Class                                                                                                                                                 
		* @param mysqli $db The database connection object 
		* @return void                                    
		*/                                                                                     
		public function __construct(mysqli $db ): void {                                                        
		$this->db = $db;                                                                        
		} 

		/**                                                                                     
		* Register a new user                                                                                                                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                     Expected keys: 'firstName', 'LastName',        
		*                                     'username', 'email',           
		*                                     'password', 'confirmPassword'.                                                                                                                   
		* @return (bool|string[]) An associative array with keys:                                        
		*             'success' (bool) - Whether the registration was successful.              
		*             'error' (string[])  - Any error messages if registration failed.            
		*/                                                                                     
		public function register(array $data): array {              
      $validatedResult = validateUserRegistration($data);
      if (!$validatedResult['isValid']) {
				return [
					'success' => 'false',
					'error'   => $validatedResult['error'],
				];
			}
			$username  = $data['username'];
			$email = $data['email']
			$firstName = $data['firstName'];
			$lastName = $data['lastName'];
			$password = $data['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $this->db->prepare("insert into user('firstname', 'lastname', 'user', 'email', 'password') 
				                          values(?,?,?,?,?)");
			$stmt->bind_param("sssss", $firstName, $lastName, $username, $email, $hashed_password);
			if($stmt->execute()){
				return [
					'success' => true,
					'error'   => null,
				];
			}
			else {
				return [
					'success' => false,
					'error'   => ["cannot register user try again later."],
				];
			}

		}                                                                                       

		/**                                                                                     
		* Authenticate a user                                                                  
		* @param string $username The username of the user                                     
		* @param string $password The 	password of the user                                    
		* @return string[] An array of user data if login is successful or null if it fails.
		* Expected keys: 'success' (bool),
		*                 'message' (string) - Login status message. 
		*/                                                                                     
		public function login(string $username, string $password): ?array { 
       $stmt = $this->db->prepare("SELECT id, username, password FROM users where username = ?");
       $stmt->bind_param("s", $username);     
 			 $stmt->execute();
 			 $result = $stmt->get_result();

 			 if ($result->num_rows() === 0) {
				 return [
					 'success' => false,
					 'message' => 'Invalid username or password',
				 ];
			 } 

			 $user = result->fetch_assoc();

			 if(password_verify($password, $user['password'])) {

				 session_start();
				 $_SESSION['user_id'] = $user['id'];
				 $_SESSION['username'] = $user['username'];

				 session_regenerate_id(true);
				 return [
					 'success' => true,
					 'message' => 'Login Sucessful.',
				 ];
				 
			 }
			 else {
				 return [
					 'success' => false,
					 'message' => 'Invalid username or password';
				 ];
			 }
		                                                               
		}


    /**
 		 * Logout the user
 		 * @return void
 		 */
		public function logout(): void {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();

			}
			// unset the session variables

			$_SESSION = array();
			session_destroy();
		}
    

		/**
 		 * Check if a user is logged in
 		 * @return bool
 		 */
		public function isLoggedIn(): bool {

			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			return isset($_SESSION['user_id']);
		}

		/**                                                                                     
		* Find a user by email address                                                         
		* @param string $email email address to search for                                     
		* return string[]|null An array of user data if found, or null if not found.              
		*/                                                                                     
		public function findUserByEmail(string $email): array|null {                                               
		//unimplemented                                                                       
		}                                                                                       
	
		/**                                                                                     
		* validate user registration data.                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                    Expected keys: 'firstName', 'LastName',         
		*                                    'username', 'email' ,            
		*                                     'password', 'confirmPassword'.                             
		* @return (bool|string[])[] An associative array with keys:                                        
		*               'isValid' (bool) - Whether the data is valid.                          
		*                'error' (?array) - Any validation error messages.                      
		*/                                                                                     
		private function validateUserRegistration(array $data): array {                                
			$username = $data['username'];
			$firstName = $data['firstName'];
			$lastName = $data['lastName'];
			$password = $data['password'];
			$confirmPassword = $data['confirmPassword'];
			return [
				'isValid' => true,
				'error' => null
			];

		} 

}                                                                                         
                                                                                      
}                                                                                         
                                                                                      
?>

```````

`/home/ramees/progs/php/sora/src/models/user.php.orig`:

```````orig
<?php                                                                                     
                                                                                      
/** User class for handling user-related operations                                       
*/                                                                                       
class User {  

		/** @var mysqli $db Database connection object */                                                  
	  private $db;    

		/**                                                                                     
		* Constructor for User Class                                                                                                                                                 
		* @param mysqli $db The database connection object 
		* @return void                                    
		*/                                                                                     
<<<<<<< HEAD
<<<<<<< HEAD
		public __construct(mysqli $db) {                                                        
=======
		public function __construct(mysqli $db ) {                                                        
>>>>>>> 9fd9574 (fix: add documentation)
=======
		public function __construct(mysqli $db ): void {                                                        
>>>>>>> aed04be (fix: implement register function)
		$this->db = $db;                                                                        
		} 

		/**                                                                                     
		* Register a new user                                                                                                                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                     Expected keys: 'firstName', 'LastName',        
		*                                     'username', 'email',           
		*                                     'password', 'confirmPassword'.                                                                                                                   
		* @return (bool|string[]) An associative array with keys:                                        
		*             'success' (bool) - Whether the registration was successful.              
		*             'error' (string[])  - Any error messages if registration failed.            
		*/                                                                                     
		public function register(array $data): array {              
      $validatedResult = validateUserRegistration($data);
      if (!$validatedResult['isValid']) {
				return [
					'success' => 'false',
					'error'   => $validatedResult['error'],
				];
			}
			$username  = $data['username'];
			$email = $data['email']
			$firstName = $data['firstName'];
			$lastName = $data['lastName'];
			$password = $data['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $this->db->prepare("insert into user('firstname', 'lastname', 'user', 'email', 'password') 
				                          values(?,?,?,?,?)");
			$stmt->bind_param("sssss", $firstName, $lastName, $username, $email, $hashed_password);
			if($stmt->execute()){
				return [
					'success' => true,
					'error'   => null,
				];
			}
			else {
				return [
					'success' => false,
					'error'   => ["cannot register user try again later."],
			}

		}                                                                                       

		/**                                                                                     
		* Authenticate a user                                                                  
		* @param string $username The username of the user                                     
		* @param string $password The 	password of the user                                    
		* @return string[]|null An array of user data if login is successful or null if it fails. 
		*/                                                                                     
		public function login(string $username, string $password): ?array {                                   
		//unimplemented                                                                       
		}

		/**                                                                                     
		* Find a user by email address                                                         
		* @param string $email email address to search for                                     
		* return string[]|null An array of user data if found, or null if not found.              
		*/                                                                                     
		public function findUserByEmail(string $email): array|null {                                               
		//unimplemented                                                                       
		}                                                                                       
	
		/**                                                                                     
		* validate user registration data.                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                    Expected keys: 'firstName', 'LastName',         
		*                                    'username', 'email' ,            
		*                                     'password', 'confirmPassword'.                             
		* @return (bool|string[])[] An associative array with keys:                                        
		*               'isValid' (bool) - Whether the data is valid.                          
		*                'error' (array) - Any validation error messages.                      
		*/                                                                                     
		private function validateUserRegistration(array $data): array {                                
			$username = $data['username'];
			$firstName = $data['firstName'];
			$lastName = $data['lastName'];
			$password = $data['password'];
			$confirmPassword = $data['confirmPassword'];

		} 
<<<<<<< HEAD

}                                                                                         
                                                                                      
=======
>>>>>>> 9fd9574 (fix: add documentation)

}                                                                                         
                                                                                      
?>

```````

`/home/ramees/progs/php/sora/src/config/database.php`:

```````php
<?php


$env = parse_ini_file("../.env");

$username = $env['USERNAME'];
$passwd = $env['PASSWORD'];
$hostname = $env['HOSTNAME'];
$database = $env['DATABASE'];

$mysqli = new mysqli($hostname, $username, $passwd, $database);

if ($mysqli->connect_error) {
  die("Connection failed ". $mysqli->connect_error);
}


?>

```````

`/home/ramees/progs/php/sora/src/config/sora.sql`:

```````sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2024 at 04:56 PM
-- Server version: 11.4.2-MariaDB
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sora`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_comments_post_id` (`post_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD KEY `idx_follows_follower_id` (`follower_id`),
  ADD KEY `idx_follows_followed_id` (`followed_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `idx_likes_post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posts_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `firstname` (`firstname`,`lastname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```````

`/home/ramees/progs/php/sora/src/config/init.php`:

```````php
<?php

define("ROOT", __DIR__."/../../");
define("APPROOT", __DIR__."/../../public/");

?>

```````

`/home/ramees/progs/php/sora/README.md`:

```````md
# സൊറ 
Micro blogging Social media platform for cs department U.C College

```````