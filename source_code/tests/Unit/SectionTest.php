<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SectionTest extends TestCase
{
    use DatabaseMigrations;
	public function setUp(){
		parent::setUp();

		$status1 = create('App\Status',['type'=> 2, 'name'=>'active_company', 'id'=>'2']);
		$status2 = create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);	
		$this->recruitment = create('App\Recruitment', ['status_id'=>$status2->id]);
		$this->company = create('App\Company', ['status_id'=>$status1->id]);
		$this->section1 = create('App\Section',['type'=>'company']);
		$this->section2 = create('App\Section',['type'=>'recruitment']);

	}

	/** @test */
	function it_has_recruitments(){
		//dd($this->recruitment->company->name);

		$this->section2->recruitments()->save($this->recruitment, ['content'=>'Noi dung section test recruitment']); 
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->section2->recruitments);
	}

	/** @test */
	function it_has_companies(){
		$this->section1->recruitments()->save($this->company, ['content'=>'Noi dung section test company']); 
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->section1->companies);
	}
}
