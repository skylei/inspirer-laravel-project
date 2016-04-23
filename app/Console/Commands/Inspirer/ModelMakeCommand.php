<?php

namespace App\Console\Commands\Inspirer;

class ModelMakeCommand extends \Illuminate\Foundation\Console\ModelMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components';
    }
}
