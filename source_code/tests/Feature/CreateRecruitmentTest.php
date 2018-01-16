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
		$this->representative = create('App\Representative', ['company_id'=>$this->company->id]);
	}

   /** @test */
	function guests_may_not_create_recruitmentss(){

        $this->post('representative/recruitment')
            ->assertRedirect('/representative');

        $this->get('representative/recruitment/create')
            ->assertRedirect('/representative');
	}	


	/** @test*/
    function an_representative_user_can_create_new_recruitment(){
    	//Givven we have a signed in user

        $this->actingAs($this->representative->account);
    	//$this->signIn();

    	$recruitment = make('App\Recruitment', ['company_id'=>$this->company->id]);
		$status = create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);

    	$tmp = $recruitment->toArray();
    	$tmp['submitbutton'] = 'Test';
    	//dd($tmp);
    	$this->post('/representative/recruitment', $tmp );

        //dd($response->headers->get('Location'));

       // dd($recruitment->path());
    	//Then, when we visit the thread page
        //$response = $this->get($thread->path());
        //dd($recruitment->path());
    	$response = $this->get($recruitment->path());
    	// We show see the new thread
    	$response->assertSee($recruitment->title);
    }


}
