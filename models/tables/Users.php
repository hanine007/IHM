<?php

namespace models\tables;

class Users{

    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public string $profile_dir;
    public bool $isAdmin;
}