<?php

namespace App\Console\Commands\Inspirer;

class ProviderMakeCommand extends \Illuminate\Foundation\Console\ProviderMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components';
    }
}
