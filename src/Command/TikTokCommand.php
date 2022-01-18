<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\CommentRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

class TikTokCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = "app:tiktok-feed";

    private $entityManager;
    private $commentRepository;

    public function __construct(EntityManagerInterface $entityManager, CommentRepository $commentRepository)
    {
        $this->entityManager = $entityManager;
        $this->commentRepository = $commentRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription("TikTok: feed")
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Dry run')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $c = new Comment();
        $c->setComment("AAAAAAAAAAA");
        $this->entityManager->persist($c);
        $this->entityManager->flush();

        $io->success(sprintf('UPDATEd "%d" old rejected/spam comments.', 99999));

        return 0;
    }
}