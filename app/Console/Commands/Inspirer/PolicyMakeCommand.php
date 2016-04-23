<?php

namespace App\Console\Commands\Inspirer;

class PolicyMakeCommand extends \Illuminate\Foundation\Console\PolicyMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Common\Policies';
    }

}
