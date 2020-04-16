<?php

namespace UniversalEducation\Api\Resources;

use UniversalEducation\Api\Resource;
use UniversalEducation\Api\Client;

class Message extends Resource
{
    protected $ignoreOnCreate = array(
        'id',
        'created_at',
        'sender_type',
        'notified',
        'seen_at',
        'updated_at',
        'sender',
        'attached_file',
        'filename'
    );
    public function create($id, $email, $files=NULL)
    {
        return Client::createMessage($id, $email, $this->getCreateFields(), $files);
    }
}