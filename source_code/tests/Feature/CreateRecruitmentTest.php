<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateRecruitmentTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp(){
		parent::setUp();
		$this->status = create('App\Status',['type'=> 3, 'name'=>'active_account', 'id'=>'5']);
		$this->company = create('App\Company');
		$this->role = create('App\Role', ['name'=>'Representative']);
		$this->representative = create('App\Representative', ['company_id'=>$this->company->id]);
		$this->representative->account->roles()->save($this->role);
	}

   /** @test */
	function guests_may_not_create_recruitmentss(){

        $this->post('representative/recruitments')
            ->assertRedirect('/representative/login');

        $this->get('representative/recruitments/create')
            ->assertRedirect('/representative/login');
	}	


	/** @test*/
    function an_representative_user_can_create_new_recruitment(){
    	//Givven we have a signed in user

        $this->actingAs($this->representative->account);
    	//$this->signIn();
        //dd($this->representative->account->isRepresentative());

        $this->assertTrue($this->representative->account->isRepresentative());

        // prepare data
    	$recruitment = make('App\Recruitment', ['company_id'=>$this->company->id, 'title'=>'test tao tin tuyen dung']);
		$status = create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$category = create('App\Category', ['name'=>'part-time']);
		$tag = create('App\Tag', ['name'=>'PHP']);
    	$section = create('App\Section', ['type'=>'Recruitment']);
    	$tmp = $recruitment->toArray();

    	$tmp['sections'][$section->id] = 'noi dung section'; 
    	$tmp['hidden-tags'] = $tag->name; 
    	$tmp['submitbutton'] = 'Đăng tin';
    	$tmp['category_id'][] = $category->id;
    	//dd($tmp);

    	//test create successful
    	$response = $this->post('/representative/recruitments', $tmp );
        //dd($response->headers->get('Location'));
    	//dd($recruitment->path());
    	//dd($recruitment);
    	$this->get($response->headers->get('Location'))
    		->assertSee($recruitment->title)
    		->assertSee($recruitment->status->name);
    		//->assertSee($recruitment->salary);
    }


}
