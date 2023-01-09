<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_select()
    {
        $response = $this->get('/overtimes');

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get('/overtimes/1');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'employee_id' => 1,
            'date' => '2023-01-01',
            'time_started' => '09:00',
            'time_ended' => '10:10',
        ];

        $response = $this->post(
            '/overtimes',
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    public function test_update()
    {
        $data = [
            'employee_id' => 1,
            'date' => '2023-02',
            'time_started' => '09:10',
            'time_ended' => '10:20',
        ];

        $response = $this->patch(
            '/overtimes/1',
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    public function test_delete()
    {
        $response = $this->delete('/overtimes/1');

        $response->assertStatus(200);
    }
}
