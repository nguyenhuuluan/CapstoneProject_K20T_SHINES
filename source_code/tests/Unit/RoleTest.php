<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoleTest extends TestCase
{
   use DatabaseMigrations;
	public function setUp(){
		parent::setUp();
		$status = create('App\Status',['type'=> 3, 'name'=>'active_account', 'id'=>'5']);
		$this->role = create('App\Role');
		$this->account = create('App\Account');
	}

	/** @test */
	function it_has_accounts(){
		$this->role->accounts()->save($this->account);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->role->accounts);
	}
}
