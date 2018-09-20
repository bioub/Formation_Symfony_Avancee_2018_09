<?php

namespace App\Manager;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactDoctrineManager implements ContactManagerInterface
{
    /** @var EntityManagerInterface */
    protected $em;

    /**
     * ContactManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        $repo = $this->em->getRepository(Contact::class);
        return $repo->findAll();
    }

    public function getById($id): Contact
    {
        return null;
    }
}