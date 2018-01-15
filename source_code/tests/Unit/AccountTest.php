<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AccountTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp(){
		parent::setUp();
		$status = create('App\Status',['type'=> 3, 'name'=>'active_account', 'id'=>'5']);
		$this->account = create('App\Account',['status_id'=>$status->id]);
	}

	 /** @test */
    function a_account_has_student(){

    	$student = create('App\Student', ['account_id'=>$this->account->id]);
    	$this->account->roles()->save(create('App\Role',['name'=>'Student']));
    	//dd($this->account->isStudent());
        $this->assertInstanceOf('App\Student', $this->account->student);
        
        $this->assertTrue($this->account->isStudent());

    }

     /** @test */
    function a_account_has_representative(){

    	$representative = create('App\Representative', ['account_id'=>$this->account->id]);
    	$this->account->roles()->save(create('App\Role',['name'=>'Representative']));

        $this->assertInstanceOf('App\Representative', $this->account->representative); 	
        $this->assertTrue($this->account->isRepresentative());

    }

     /** @test */
    function a_account_has_staff(){

    	$staff = create('App\Staff', ['account_id'=>$this->account->id]);
    	$this->account->roles()->save(create('App\Role',['name'=>'Admin']));

        $this->assertInstanceOf('App\Staff', $this->account->staff); 
        $this->assertTrue($this->account->isAdmin());

    }

     /** @test */
    function a_account_has_blogs(){
    	$this->blog = 	create('App\Blog',['account_id'=>$this->account->id]);
    	//dd($this->account->blogs);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->account->blogs); 
    }


}
