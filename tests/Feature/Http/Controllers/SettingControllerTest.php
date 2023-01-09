<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_select()
    {
        $response = $this->get('/settings');

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get('/settings/1');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'key' => 'overtime_method',
            'value' => '1',
        ];

        $response = $this->post('/settings',
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    public function test_update()
    {
        $data = [
            'key' => 'overtime_method',
            'value' => '2',
        ];

        $response = $this->patch('/settings/1',
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    public function test_delete()
    {
        $response = $this->delete('/settings/1');

        $response->assertStatus(200);
    }
}
