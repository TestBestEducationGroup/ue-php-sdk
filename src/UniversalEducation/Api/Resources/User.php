<?php

namespace UniversalEducation\Api\Resources;

use UniversalEducation\Api\Resource;
use UniversalEducation\Api\Client;

class User extends Resource
{
    protected $ignoreOnCreate = array(
        'id',
        'token',
        'account',
        'has_img_changed',
        'can_book_half_hour',
        'has_logged_in',
        'school',
    );
    protected $ignoreOnUpdate = array(
        'id',
        'email',
        'token',
        'account',
        'has_img_changed',
        'can_book_half_hour',
        'has_logged_in',
        'school',
    );
    public function create()
    {
        return Client::createUser($this->getCreateFields());
    }
    public function update()
    {
        return Client::updateUser($this->id, $this->getUpdateFields());
    }
}