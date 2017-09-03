<?php

namespace Suomato\Commands;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeRoute extends Command
{
    protected function configure()
    {
        $this->setName('make:route')
             ->setDescription('Create a new route for WordPress API')
             ->addArgument('name', InputArgument::REQUIRED, 'Route file name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name                 = strtolower($input->getArgument('name'));
        $filename             = "{$name}.php";
        $routes_location      = new Local(__DIR__ . '/../../../../../app/config/wp/routes');
        $boilerplate_location = new Local(__DIR__ . '/../templates');
        $routes               = new Filesystem($routes_location);
        $boilerplate          = new Filesystem($boilerplate_location);
        $template             = $boilerplate->read('route.php');

        // If file already exists
        if ($routes->has($filename)) {
            $output->writeln("<error>{$filename} already exists!</error>");

            return 0;
        }

        $routes->write("{$name}.php", $template);

        $output->writeln("<info>Route created successfully.</info>");
    }
}
