<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_select()
    {
        $response = $this->get('/employees');

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get('/employees/1');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'name' => 'User',
            'salary' => 2000000,
        ];

        $response = $this->post(
            '/employees',
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    public function test_update()
    {
        $data = [
            'name' => 'User',
            'salary' => 2500000,
        ];

        $response = $this->patch(
            '/employees/3',
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    public function test_delete()
    {
        $response = $this->delete('/employees/3');

        $response->assertStatus(200);
    }
}
