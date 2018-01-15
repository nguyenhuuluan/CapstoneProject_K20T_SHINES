<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StatusTest extends TestCase
{	

    use DatabaseMigrations;
	public function setUp(){
		parent::setUp();
		$this->status1 = create('App\Status',['type'=> 3, 'name'=>'active_account', 'id'=>'5']);
		$this->status2 = create('App\Status',['type'=> 2, 'name'=>'active_company', 'id'=>'3']);
		$this->status3 = create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
	}

	/** @test */
	function it_has_accounts(){
		$account = create('App\Account', ['status_id'=>$this->status1->id]);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->status1->accounts);
	}

	/** @test */
	function it_has_recruitments(){
		$recruitment = create('App\Recruitment', ['status_id'=>$this->status3->id]);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->status3->recruitments);
	}

	/** @test */
	function it_has_companies(){
		$company = create('App\Company', ['status_id'=>$this->status2->id]);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->status2->companies);
	}
}
