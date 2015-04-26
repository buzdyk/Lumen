<?php

class ExampleTest extends TestCase {

    /**
     * @todo find out why post payload is empty
     * @test
     */
    public function it_registers_new_user()
    {
        $payload = [
            'email'     => $this->fake->email,
            'password'  => $this->fake->word,
            'first_name'=> $this->fake->firstName,
            'last_name' => $this->fake->lastName,
        ];

        $this->assertEquals(0, App\User::count());

        $response = $this->call('post', '/register', $payload);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(1, App\User::count());
    }
}
