<?php

namespace UniversalEducation\Api\Resources;

use UniversalEducation\Api\Resource;
use UniversalEducation\Api\Client;

class Homework extends Resource
{
    public function create($course_id, $lesson_id, $email, $files=NULL)
    {
        return Client::createHomework($course_id, $lesson_id, $email, $this->getCreateFields(), $files);
    }
}