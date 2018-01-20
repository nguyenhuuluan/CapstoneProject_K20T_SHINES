<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RepresentativeTest extends TestCase
{
	use DatabaseMigrations;
	public function setUp(){
		parent::setUp();
		$status = create('App\Status',['type'=> 3, 'name'=>'active_account', 'id'=>'5']);
		$this->representative = create('App\Representative');

	}

	/** @test */
	function it_has_account(){
		$this->assertInstanceOf('App\Account', $this->representative->account);
	}

	/** @test */
	function it_has_company(){

		$this->assertInstanceOf('App\Company', $this->representative->company);
		
	}
}
