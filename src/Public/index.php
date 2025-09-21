<?php

require_once '../Models/User.php';
require_once '../Service/UserManager.php';
require_once '../Utils/Validator.php';

$initialUsers = [['id' => 1, 'name' => 'João Silva', 'email' => 'joao@email.com', 'password' => 'SenhaForte1'], ];

// Casos de uso