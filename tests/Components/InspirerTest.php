<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InspirerTest extends TestCase
{

    public function testApplication()
    {
        $this->assertInstanceOf(\App\Components\Inspirer\Application::class, $this->app);
        $this->assertInstanceOf(\App\Components\Inspirer\Http\Request::class, $this->app['request']);
    }
}
