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

    private function findUserById(int $id): ?User {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        return null;
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

    private function handlePasswordValidation(string $password): ?string {
        if (!Validator::validatePassword($password)) {
            return "Erro: A senha precisa ter pelo menos 8 caracteres, um número e uma letra maiúscula.";
        }
        return null;
    }

    public function registerUser(string $name, string $email, string $password): string
    {
        if (!Validator::validateEmail($email)) {
            return "Erro: E-mail inválido.";
        }

        if ($error = $this->handlePasswordValidation($password)) {
            return $error;
        }

        if ($this->findUserByEmail($email) !== null) {
            return "Erro: E-mail já está em uso.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser = new User($this->nextId, $name, $email, $hashedPassword);

        $this->users[] = $newUser;
        $this->nextId++; 

        return "Sucesso: Usuário cadastrado";
    }

    public function loginUser(string $email, string $password): string
    {
        $user = $this->findUserByEmail($email);

        if ($user === null || !password_verify($password, $user->getPassword())) {
            return "Erro: Credenciais inválidas.";
        }
        return "Sucesso: Login do usuário {$email} realizado com sucesso.";
    }
} 
