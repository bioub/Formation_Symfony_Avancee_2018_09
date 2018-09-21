<?php

namespace App\Command;

use App\Entity\Contact;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FixtureLoadCommand extends Command
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    protected $em;


    protected static $defaultName = 'fixture:load';

    /**
     * FixtureLoadCommand constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(\Doctrine\ORM\EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Insert contacts in db')
          //  ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'contact nb')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nb = $input->getOption('count') ?? 10;

        for ($i=1; $i<=$nb; $i++) {
            $c = new Contact();
            $c->setId($i);
            $c->setFirstName('Firstname ' . $i);
            $c->setLastName('Lastname ' . $i);

            $this->em->persist($c);
        }

        $this->em->flush();

        $io = new SymfonyStyle($input, $output);
        $io->success($nb . ' contacts created');
    }
}
