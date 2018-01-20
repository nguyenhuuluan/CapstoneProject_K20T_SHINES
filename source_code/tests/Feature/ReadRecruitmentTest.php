<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadRecruitmentTest extends TestCase
{

	use DatabaseMigrations;

	public function setUp(){
		parent::setUp();

		$this->status = create('App\Status',['type'=> 1, 'name'=>'active_recruitment']);

		$this->company = create('App\Company', ['name'=>'DXC']);

		$this->recruitment = create('App\Recruitment',
			['title'=>'Tuyen dung Senior PHP',
			'status_id'=>$this->status->id,
			'company_id'=>$this->company->id,
		]);
		$this->recruitment->categories()->save(create('App\Category', ['name'=>'full-time']));
		$this->address = create('App\Address', ['company_id'=>$this->company->id]);	
		$this->recruitment->sections()->save(make('App\Section', ['type'=>'recruitment']), ['content'=>'content section']);

	}

	/** @test*/
	function a_user_can_view_all_recrutiments()
	{
		$this->get('/home')
			->assertSee($this->recruitment->title)
			->assertSee($this->recruitment->company->name)
			->assertSee($this->recruitment->categories->first()->name)
			->assertSee($this->address->district->city->name);
	}

	/** @test */

	function a_user_can_view_single_recruitment()
	{	
		//dd($this->recruitment->salary);

		//$section = create('App\Section');
		//dd($this->recruitment->sections->first()->pivot->content);

		$this->get($this->recruitment->path())
			->assertSee($this->recruitment->title)
			->assertSee($this->recruitment->company->name)
			->assertSee($this->recruitment->categories->first()->name)
			->assertSee((string)$this->recruitment->salary)
			->assertSee($this->recruitment->sections->first()->title)
			->assertSee($this->recruitment->sections->first()->pivot->content);
			
	}

}
