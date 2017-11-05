<?php

namespace Suomato\Commands;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Suomato\build_shortcode;

class MakeShortcode extends Command
{
    protected function configure()
    {
        $this->setName('make:shortcode')
             ->setDescription('Create a new Shortcode')
             ->addArgument('name', InputArgument::REQUIRED, 'Shortcode name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name                 = $input->getArgument('name');
        $filename             = "{$name}.php";
        $shortcodes_location  = new Local(__DIR__ . '/../../../../../app/config/wp/shortcodes');
        $boilerplate_location = new Local(__DIR__ . '/../templates');
        $shortcodes           = new Filesystem($shortcodes_location);
        $boilerplate          = new Filesystem($boilerplate_location);
        $template             = $boilerplate->read('shortcode.php');

        // If file already exists
        if ($shortcodes->has($filename)) {
            $output->writeln("<error>{$filename} already exists!</error>");

            return 0;
        }

        $content = build_shortcode($template, $name);
        $shortcodes->write("{$name}.php", $content);

        $output->writeln("<info>Shortcode created successfully.</info>");
    }
}
