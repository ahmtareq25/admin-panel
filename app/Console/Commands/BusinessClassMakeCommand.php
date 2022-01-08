<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class BusinessClassMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:businessClass {name}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Class';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Business Class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/businessClass.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\BusinessClass';
    }
}
