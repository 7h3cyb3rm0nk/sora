<?php
namespace Sora\Models;

use Sora\Models\UserModel;
class AdminModel{
    private \mysqli $db;
  

    public function __construct(\mysqli $db){

        $this->db = $db;
        

    }

    

    

}

?>