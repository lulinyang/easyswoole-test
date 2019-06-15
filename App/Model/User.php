<?php

namespace App\Model;

class User extends Model
{
    protected $createTime = true;
    protected $createTimeName = 'create_at';
    protected $dbFields = [
        'id' => ['int'],
        'name' => ['text'],
        'email' => ['text'],
        'created_at' => ['int'],
        'updated_at' => ['int'],
    ];
}
