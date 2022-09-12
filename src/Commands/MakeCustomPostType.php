<?php

namespace Suomato\Commands;

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use function Suomato\build_custom_post_type;
use function Suomato\build_content;

class MakeCustomPostType extends Command
{
    protected function configure()
    {
        $this->setName('make:custom-post-type')
             ->setDescription('Create a new Custom Post Type')
             ->addArgument('name', InputArgument::REQUIRED, 'Custom Post Type name(singular form)')
             ->addOption(
                 'plural',
                 null,
                 InputOption::VALUE_OPTIONAL,
                 'Define plural form if noun have irregular plural which do not behave in standard way(singular+s)'
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name                             = strtolower($input->getArgument('name'));
        $filename                         = "{$name}.php";
        $modelfile                        = ucfirst($name) . '.php';
        $custom_post_types_location       = new LocalFilesystemAdapter(__DIR__ . '/../../../../../app/config/wp/custom-post-types');
        $model_location                   = new LocalFilesystemAdapter(__DIR__ . '/../../../../../app/models');
        $boilerplate_location             = new LocalFilesystemAdapter(__DIR__ . '/../templates');
        $cpt                              = new Filesystem($custom_post_types_location);
        $models                           = new Filesystem($model_location);
        $boilerplate                      = new Filesystem($boilerplate_location);
        $template                         = $boilerplate->read('custom-post-type.php');
        $model_template                   = $boilerplate->read('post-type-model.php');
        $plural                           = empty($input->getOption('plural')) ? null : strtolower($input->getOption('plural'));

        // If file already exists
        if ($cpt->fileExists($filename)) {
            $output->writeln("<error>{$filename} already exists!</error>");

            return 0;
        }

        // If file already exists
        if ($models->fileExists($modelfile)) {
            $output->writeln("<error>{$modelfile} already exists!</error>");

            return 0;
        }

        $content = build_custom_post_type($template, $name, $plural);
        $cpt->write("{$name}.php", $content);

        $content = build_content($model_template, ucfirst($name));
        $models->write($modelfile, $content);

        $output->writeln('<info>Custom Post Type created successfully.</info>');

        return 0;
    }
}
