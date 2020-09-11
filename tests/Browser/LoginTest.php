<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{

    public function testLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('user/login')
                ->type('email', 'luzdosol@gmail.com')
                ->type('password', 'luzsol2020')
                ->press('LOGIN');
            $browser->assertSee('Guilherme Neto');
        });
    }
}
