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
