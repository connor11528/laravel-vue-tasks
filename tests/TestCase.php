<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

    protected function signIn($user = null)
    {
        // use passed in user or create one
        $user = $user ?: create('App\User');
        $this->actingAs($user);
        return $this;
    }
}
