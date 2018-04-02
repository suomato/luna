<?php

namespace Suomato\Commands;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use function Suomato\build_content;

class MakeMenuPage extends Command
{
    protected function configure()
    {
        $this->setName('make:menu-page')
             ->setDescription('Create a new Menu Page')
             ->addArgument('name', InputArgument::REQUIRED, 'Menu Page name')
             ->addOption(
                 'submenu',
                 null,
                 InputOption::VALUE_NONE,
                 'Make Submenu Page instead of top-level Menu Page'
             );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $template_name        = $input->getOption('submenu') ? 'submenu-page.php' : 'menu-page.php';
        $folder_name          = $input->getOption('submenu') ? 'submenu-pages' : 'menu-pages';
        $info_text            = $input->getOption('submenu') ? 'Submenu Page' : 'Menu Page';

        $name                 = $input->getArgument('name');
        $filename             = "{$name}.php";
        $menu_pages_location  = new Local(__DIR__ . '/../../../../../app/config/wp/' . $folder_name);
        $boilerplate_location = new Local(__DIR__ . '/../templates');
        $menu_pages           = new Filesystem($menu_pages_location);
        $boilerplate          = new Filesystem($boilerplate_location);
        $template             = $boilerplate->read($template_name);

        // If file already exists
        if ($menu_pages->has($filename)) {
            $output->writeln("<error>{$filename} already exists!</error>");

            return 0;
        }

        $content = build_content($template, $name);
        $menu_pages->write("{$name}.php", $content);

        $output->writeln('<info>' . $info_text . ' created successfully.</info>');
    }
}
