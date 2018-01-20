<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompanyTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp(){
		parent::setUp();
		$status = create('App\Status',['type'=> 2, 'name'=>'active_company', 'id'=>'3']);

		$this->company = create('App\Company', ['status_id'=>$status->id]);
		$this->address = create('App\Address',['company_id'=>$this->company->id]);

	}

	/** @test */
	function it_has_address(){
		$this->assertInstanceOf('App\Address', $this->company->address);
	}

	/** @test */
	function it_has_representatives(){

		$representative = create('App\Representative', ['company_id'=>$this->company->id]);

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->company->representatives);
	}

	/** @test */
	function it_has_recruitments(){

		$recruitment = create('App\Recruitment', ['company_id'=>$this->company->id]);

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->company->recruitments);
	}

	/** @test */
	function it_has_tags(){
		$tag = create('App\Tag');
		$this->company->tags()->save($tag);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->company->tags);
	}
}
