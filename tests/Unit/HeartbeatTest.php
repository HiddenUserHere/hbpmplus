<?php

namespace Tests\Unit;

use Tests\TestCase;

class HeartbeatTest extends TestCase
{
    /**
     * Test if its possible to create a user from api post request.
     * 
     * @return void
     */
    public function test_that_a_user_can_be_created()
    {
        $response = $this->postJson('/api/newtoken');

        $response->assertStatus(201);
    }

    /**
     * Test if its possible to create a heartbeat from api post request.
     * 
     * @return void
     */
    public function test_that_a_heartbeat_can_be_created()
    {
        $response = $this->postJson('/api/newtoken');

        $response->assertStatus(201);

        $response = $this->postJson('/api/heartbeat/tick', [
            'time' => 1000,
            'api_token' => $response->json('token'),
        ]);

        $response->assertStatus(201);
    }
}
