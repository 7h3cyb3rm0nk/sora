<?php                                                                                     
                                                                                      
/** User class for handling user-related operations                                       
*/                                                                                       
class User {  

		/** @var mysqli Database connection */                                                  
	  private $db;    

		/**                                                                                     
		* Constructor for User Class                                                                                                                                                 
		* @param mysqli $db The database connection object                                     
		*/                                                                                     
		public __construct(mysqli $db) {                                                        
		$this->db = $db;                                                                        
		} 

		/**                                                                                     
		* Register a new user                                                                                                                                                     
		* @param array $data An associative array containing user registration data.           
		*                     Expected keys: 'firstName' (string), 'LastName' (string),        
		*                                     'username' (string), 'email' (string),           
		*                                     'password' (string).                                                                                                                   
		* @return array An associative array with keys:                                        
		*             'success' (bool) - Whether the registration was successful.              
		*             'error' (array)  - Any error messages if registration failed.            
		*/                                                                                     
		public function register(array $data): array {                                          
			//unimplemented                                                                                    
		}                                                                                       

		/**                                                                                     
		* Authenticate a user                                                                  
		* @param string $username The username of the user                                     
		* @param string $password The 	password of the user                                    
		* @return array|null An array of user data if login is successful or null if it fails. 
		*/                                                                                     
		public function login($username, $password): ?array {                                   
		//unimplemented                                                                       
		}

		/**                                                                                     
		* Find a user by email address                                                         
		* @param string $email email address to search for                                     
		* return array|null An array of user data if found, or null if not found.              
		*/                                                                                     
		public function findUserByEmail($email) {                                               
		//unimplemented                                                                       
		}                                                                                       
	
		/**                                                                                     
		* validate user registration data.                                                     
		* @param array $data An associative array containing user registration data.           
		*                    Expected keys: 'firstName' (string), 'LastName' (string),         
		*                                    'username' (string), 'email' (string),            
		*                                     'password' (string).                             
		* @return array An associative array with keys:                                        
		*               'isValid' (bool) - Whether the data is valid.                          
		*                'error' (array) - Any validation error messages.                      
		*/                                                                                     
		private function validateUserRegistration(array $data) {                                
		// unimplemented                                                                      
		} 

}                                                                                         
                                                                                      

