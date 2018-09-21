<?php

namespace App\Manager;


use App\Entity\Contact;
use Symfony\Component\BrowserKit\Client;

class ContactRestManager implements ContactManagerInterface
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /**
     * ContactRestManager constructor.
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function getAll()
    {
        $response = $this->client->get('https://jsonplaceholder.typicode.com/users');

        $array = \json_decode($response->getBody(), true);
        $contacts = [];

        foreach ($array as $item) {
            $c = new Contact();
            $c->setFirstName($item['name']);
            $c->setId($item['id']);

            $contacts[] = $c;
        }

        return $contacts;
    }

    public function getById($id): Contact
    {
        // TODO: Implement getById() method.
    }
}