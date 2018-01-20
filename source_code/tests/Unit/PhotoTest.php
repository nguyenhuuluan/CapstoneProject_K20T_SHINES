<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhotoTest extends TestCase
{
   use DatabaseMigrations;
 	/** @test */
	function test(){
		$this->assertTrue(true);
	}
}
