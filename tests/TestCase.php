<?php

use App\Post, App\User;

class TestCase extends Laravel\Lumen\Testing\TestCase {

    protected $fake;

    public function __construct()
    {
        $this->fake = Faker\Factory::create();
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        Illuminate\Support\Facades\Artisan::call('migrate');

        return $app;
    }

    protected function makeUser()
    {
        User::unguard();
        $user = User::create([
            'email' => $this->fake->unique()->email,
            'password'   => $this->fake->word,
            'first_name' => $this->fake->firstName,
            'last_name'  => $this->fake->lastName,
        ]);
        User::reguard();

        return $user;
    }

    protected function makePost($user = null)
    {
        if ($user == null) {
            $user = $this->makeUser();
        }

        $post = new Post();
        $post->content = $this->fake->sentences(10);
        $post->user()->associate($user);
        $post->save();

        return $post;
    }

}
