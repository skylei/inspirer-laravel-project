<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Components\UserSystem\User;
use App\Components\UserSystem\Administrator;

class UserSystemTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function makeUser()
    {
        $user = (new User())->setEmail('test@test.com')->setName('test')->setPassword('123456');
        $user->save();

        return $user;
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function makeAdmin()
    {
        $admin = (new Administrator())->setName('test')->setEmail('test@test.com')->setPassword('123465');
        $admin->save();

        return $admin;
    }
    
    public function testLoginEvent()
    {
        $admin = $this->makeAdmin();
        $times = $admin->login_times;

        Auth::guard('admin')->login($admin);

        $this->seeInDatabase('admin_operational_logs', ['level' => 'info', 'operator_id' => $admin->id]);
        $this->assertEquals(1, $admin->login_times - $times);
    }
}
