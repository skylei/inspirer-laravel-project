<?php

namespace App\Console\Commands\Inspirer;

class JobMakeCommand extends \Illuminate\Foundation\Console\JobMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Framework\Kernel\Jobs';
    }

    protected function getStub()
    {
        if ($this->option('sync')) {
            return app_path('Components/Inspirer/Stubs/job.stub');
        } else {
            return app_path('Components/Inspirer/Stubs/job-queued.stub');
        }
    }
}
