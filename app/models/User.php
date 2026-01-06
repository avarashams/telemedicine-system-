<?php

class User
{
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'email',
        'password',
        'role',
        'remember_token'
    ]; // specify which columns are allowed to be inserted or updated
    

    public function find_by_email($email)
    {
        return $this->first(['email' => $email]);
    }
    
    public function save_remember_token($userId, $token)
    {
        return $this->update($userId, ['remember_token' => $token]);
    }
    public function delete_remember_token($userId)
    {
        return $this->update($userId, ['remember_token' => null]);
    }

    public function authenticate($email, $password)
    {
        $user = $this->find_by_email($email);
        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }    
}