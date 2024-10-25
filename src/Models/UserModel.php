<?php                                         
namespace Sora\Models;
// require_once __DIR__."../../vendor/autoload.php"; 
/** User class for handling user-related operations                                       
 */

class UserModel {  

		/** @var mysqli $db Database connection object */                                                  
	  private $db;    

		/**                                                                                     
		* Constructor for User Class                                                                                                                                                 
		* @param mysqli $db The database connection object 
		*/                                                                                     
		public function __construct(\mysqli $db ) {                                                        
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
      $validatedResult = $this->validate_user_registration($data);
      if (!$validatedResult['isValid']) {
				return [
					'success' => 'false',
					'error'   => $validatedResult['error'],
					'user' => null
				];
			}
			$username  = $data['username'];
			$email = $data['email'];
			$firstName = $data['firstname'];
			$lastName = $data['lastname'];
			$password = $data['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);


			$stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? or email = ?");
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				return [
					'success' => false,
					'error' => ["USER ALREADY EXISTS"],
					'user' => null,
				];
			}

			$stmt = $this->db->prepare("insert into users(firstname, lastname, username, email, password) 
				                          values(?,?,?,?,?)");
			$stmt->bind_param("sssss", $firstName, $lastName, $username, $email, $hashed_password);
			if($stmt->execute()){
				$query = $this->db->prepare("select id from users where username = ?");
				$query->bind_param("s", $username);
				$query->execute();
				$result = $query->get_result();
				$user = $result->fetch_assoc();
				return [
					'success' => true,
					'error'   => null,
					'user' => $user,
				];
			}
			else {
				return [
					'success' => false,
					'error'   => ["cannot register user try again later."],
					'user' => null
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
		*                 'user'  (array) - user details.
		*/                                                                                     
	public function authenticate(string $username, string $password): ?array { 
       $stmt = $this->db->prepare("SELECT id, username, password FROM users where username = ? or email = ?" );
       $stmt->bind_param("ss", $username,$username);     
 			 $stmt->execute();
 			 $result = $stmt->get_result();

 			 if ($result->num_rows === 0) {
				 return [
					 'success' => false,
					 'message' => 'INVALID_DETAILS_ERROR',
				 ];
			 } 

			 $user = $result->fetch_assoc();

			 if(password_verify($password, $user['password'])) {

				 return [
					 'success' => true,
					 'message' => 'LOGIN_SUCCESSFUL',
					 'user' => $user,
				 ];
				 
			 }
			 else {
				 return [
					 'success' => false,
					 'message' => 'INVALID_PASSWORD_ERROR',
				 ];
			 }
		                                                               
		}


    


		/**                                                                                     
		* Find a user by email address                                                         
		* @param string $email email address to search for                                     
		* return string[]|null An array of user data if found, or null if not found.              
		*/                                                                                     
	public function find_user_by_email(string $email): array|null {                                               
	  $stmt = $this->db->prepare("select * from users where email=? limit 1"); 
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows() === 0) {
				return null;
			}
			else {
				$user = $result->fetch_assoc();
				return $user;
			}
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
	private function validate_user_registration(array $data): array {                                
			$username = $data['username'];
			$firstName = $data['firstname'];
			$lastName = $data['lastname'];
			$password = $data['password'];
			$retype_password = $data['retype_password'];

			
			return [
				'isValid' => true,
				'error' => null
			];

	} 

public function get_user_details($username): array{
	$stmt = $this->db->prepare("SELECT * from users where username = ? limit 1");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
	$rows = $result->fetch_assoc();
	return $rows;
	}
	else{
		return Array();
	}
}


private function handle_profile_picture($files, $action) {
	$userId = $_SESSION['user_id'];
	
	// Get current profile picture
	$stmt = $this->db->prepare("SELECT profile_picture FROM users WHERE id = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	$current_picture = $user['profile_picture'] ?? null;

	
			if (isset($files['profile_picture']) && $files['profile_picture']['error'] === UPLOAD_ERR_OK) {
				// Delete old file if exists
				if ($current_picture && file_exists($current_picture)) {
					unlink($current_picture);
				}
				
				// Handle new upload
				$file = $files['profile_picture'];
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$filename = 'profile_' . $userId .'.' . $ext;
				$upload_path = '/images/pfps/' . $filename;
				
				if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
					throw new \Exception("Failed to upload profile picture");
				}
				
				return $upload_path;
			}
			
		
	
	return null;
}

public function update_user_details($username, $data){
	$update_fields = array();
	if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["name"] != ""  ){

	$uploadfile = $this->handle_profile_picture($_FILES, 'update');
	move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadfile);
	$data["profile_picture"] = $uploadfile;
	

	}

	if($_POST["profile_picture_state"] === "delete"){
		$data["profile_picture"] = "/images/icons/user-avatar.png";
	}
	
	

		$original_fields = $this->get_user_details($username);
		// if($data["profile_picture"] == "./images/pfps/"){
		// 	$data["profile_picture"] = NULL;
		// }
		if(!isset($_FILES["profile_picture"]) && file_exists($original_fields["profile_picture"])){
			unlink($current_picture);
		}
		if($original_fields){
			foreach($data as $field => $value){
				if ($original_fields[$field] !== $value){
					$update_fields[$field] = $value;
				}
			}
			return $this->update($username, $update_fields);
		}
		else{
			return false;
		}
}

function update($username, $data){
	
	if (!empty($data)){
		$sql = "UPDATE users set ";
		foreach($data as $key => $value){
			$sql .= "$key = '$value', ";

		}
		$sql = rtrim($sql, ", ");
		$sql .= " WHERE username=?";
		

		$stmt = $this->db->prepare($sql);
		
		$stmt->bind_param("s", $username);
		
		
		return $stmt->execute();
	}
	else{
		return false;
	}
	
}

}                   

function test_input(string $data): string{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;

}

                                                                                      
?>
