<?php

namespace Suomato\Commands;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use function Suomato\build_custom_taxonomy;
use function Suomato\build_content;

class MakeCustomTaxonomy extends Command
{
    protected function configure()
    {
        $this->setName('make:custom-taxonomy')
             ->setDescription('Create a new Custom Taxonomy')
             ->addArgument('name', InputArgument::REQUIRED, 'Custom Taxonomy name(singular form)')
             ->addOption(
                 'plural',
                 null,
                 InputOption::VALUE_OPTIONAL,
                 'Define plural form if noun have irregular plural which do not behave in standard way(singular+s)'
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name                                           = strtolower($input->getArgument('name'));
        $filename                                       = "{$name}.php";
        $modelfile                                      = ucfirst($name) . '.php';
        $custom_taxonomy_location                       = new Local(__DIR__ . '/../../../../../app/config/wp/custom-taxonomies');
        $model_location                                 = new Local(__DIR__ . '/../../../../../app/models');
        $boilerplate_location                           = new Local(__DIR__ . '/../templates');
        $custom_taxonomies                              = new Filesystem($custom_taxonomy_location);
        $models                                         = new Filesystem($model_location);
        $boilerplate                                    = new Filesystem($boilerplate_location);
        $template                                       = $boilerplate->read('custom-taxonomy.php');
        $model_template                                 = $boilerplate->read('taxonomy-model.php');
        $plural                                         = empty($input->getOption('plural')) ? null : strtolower($input->getOption('plural'));

        // If file already exists
        if ($custom_taxonomies->has($filename)) {
            $output->writeln("<error>{$filename} already exists!</error>");

            return 0;
        }

        // If file already exists
        if ($models->has($modelfile)) {
            $output->writeln("<error>{$modelfile} already exists!</error>");

            return 0;
        }

        $content = build_custom_taxonomy($template, $name, $plural);
        $custom_taxonomies->write("{$name}.php", $content);

        $content = build_content($model_template, ucfirst($name));
        $models->write($modelfile, $content);

        $output->writeln('<info>Custom Taxonomy created successfully.</info>');
    }
}
