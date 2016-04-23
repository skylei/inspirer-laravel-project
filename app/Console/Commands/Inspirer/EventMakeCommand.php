<?php

namespace App\Console\Commands\Inspirer;

class EventMakeCommand extends \Illuminate\Foundation\Console\EventMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components';
    }

    protected function getStub()
    {
        return app_path('Components/Inspirer/Stubs/event.stub');
    }


}
