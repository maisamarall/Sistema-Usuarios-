<?php

require_once '../Models/User.php';
require_once '../Utils/Validator.php';

class UserManager {
    private array $users;
    private int $nextId;
    
    public function __construct(array $initialUsers)
    {
        $this-> users = $initialUsers;
        $this->nextId = count($this->users) + 1;
    }

    // encontra um usuario pelo email
    private function findUserByEmail(string $email): ?User {
        foreach ($this->users as $user) {
            if ($user->getEmail()=== $email) {
                return $user;
            }
        }
        return null;
    }    
} 
