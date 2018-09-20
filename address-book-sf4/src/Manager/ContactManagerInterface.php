<?php

namespace App\Manager;


use App\Entity\Contact;

interface ContactManagerInterface
{
    public function getAll();
    public function getById($id): Contact;
}