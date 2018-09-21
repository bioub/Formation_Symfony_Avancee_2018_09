<?php

namespace App\Tests\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testListContains3ContactsInMySQL()
    {
        $client = static::createClient();

        $mockRepo = $this->getMockBuilder(ContactRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockRepo->expects($this->exactly(1))
                 ->method('findAll')
                 ->willReturn([
                     (new Contact())->setId(1)->setFirstName('A')->setLastName('B'),
                     (new Contact())->setId(2)->setFirstName('C')->setLastName('D'),
                     // (new Contact())->setId(3)->setFirstName('E')->setLastName('F'),
                 ]);

        $mockDoctrine = $this->getMockBuilder(ManagerRegistry::class)
            ->getMock();

        $mockDoctrine->expects($this->once())
            ->method('getRepository')
            ->willReturn($mockRepo);

        static::$container->set('doctrine', $mockDoctrine);

        $crawler = $client->request('GET', '/contacts/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(2, $crawler->filter('.table tbody tr'));
    }
}
