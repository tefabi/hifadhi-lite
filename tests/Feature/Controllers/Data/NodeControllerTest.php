<?php

namespace Tests\Feature\Controllers\Data;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NodeControllerTest extends TestCase
{
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function test_can_get_node_definition_list()
  {
    $response = $this->get('/api/v1/nodes/');

    $response->assertStatus(200);
  }
}
