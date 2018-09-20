<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /** @var \App\Entity\Contact */
    protected $contact;

    public function setUp()
    {
        $this->contact = new Contact();
    }

    public function testPropertyFirstName()
    {
        $this->contact->setFirstName('Jean');
        $this->assertEquals('Jean', $this->contact->getFirstName());
    }

    public function testPropertyLastName()
    {
        $this->contact->setFirstName('Dupont');
        $this->assertEquals('Dupont', $this->contact->getFirstName());
    }
}