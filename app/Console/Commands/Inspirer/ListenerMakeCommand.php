<?php

namespace App\Console\Commands\Inspirer;

class ListenerMakeCommand extends \Illuminate\Foundation\Console\ListenerMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components';
    }

}
