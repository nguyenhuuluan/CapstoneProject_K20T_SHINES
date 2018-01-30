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
		$this->role1 = create('App\Role', ['name'=>'Admin']);
		$this->representative = create('App\Representative', ['company_id'=>$this->company->id]);
		$this->staff= create('App\Staff');
		$this->staff->account->roles()->save($this->role1);
		$this->representative->account->roles()->save($this->role);
	}
	/** @test */
	function guests_may_not_create_recruitments(){

		$this->post('representative/recruitments')
		->assertRedirect('/representative/login');

		$this->get('representative/recruitments/create')
		->assertRedirect('/representative/login');
	}	


	/** @test*/
	function an_representative_user_can_create_new_recruitment(){

		$this->actingAs($this->representative->account);

        //check login with representative
		$this->assertTrue($this->representative->account->isRepresentative());

        //prepare data
		$recruitment = make('App\Recruitment',
			['company_id'=>$this->company->id, 'title'=>'Tuyển dụng Senior PHP','salary'=>'7.000.000VNĐ']);

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
		->assertSee($recruitment->status->name)
		->assertSee($recruitment->salary);
	}

	/** @test*/
	function unauthenticated_may_not_approve_a_recruitment()
	{

		create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$status = create('App\Status',['type'=> 1, 'name'=>'approve_recruitment', 'id'=>'8']);
		$recruitment = create('App\Recruitment', ['status_id'=>$status->id]);
		
		$this->get('/admin/recruitments/approve/'.$recruitment->id)
		->assertRedirect('/admin/login');	
	}

	/** @test*/
	function admin_can_approve_a_recruitment()
	{
		$this->actingAs($this->staff->account);
		$this->assertTrue($this->staff->account->isAdmin());
		create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$status = create('App\Status',['type'=> 1, 'name'=>'approve_recruitment', 'id'=>'8']);
		$recruitment = create('App\Recruitment', ['status_id'=>$status->id]);
		
		$this->get('/admin/recruitments/approve/'.$recruitment->id)
		->assertJson(['isSuccess' => true]);
	}

	/** @test*/
	function admin_can_active_a_recruitment()
	{
		$this->actingAs($this->staff->account);
		$this->assertTrue($this->staff->account->isAdmin());
		create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$status = create('App\Status',['type'=> 1, 'name'=>'inactive_recruitment', 'id'=>'2']);
		$recruitment = create('App\Recruitment', ['status_id'=>$status->id]);
		
		$this->get('/admin/recruitments/active/'.$recruitment->id)
		->assertJson(['status_id' => 1]);
	}

	/** @test*/
	function admin_can_unactive_a_recruitment()
	{
		$this->actingAs($this->staff->account);
		$this->assertTrue($this->staff->account->isAdmin());
		create('App\Status',['type'=> 1, 'name'=>'inactive_recruitment', 'id'=>'2']);
		$status = create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$recruitment = create('App\Recruitment', ['status_id'=>$status->id]);
		
		$this->get('/admin/recruitments/active/'.$recruitment->id)
		->assertJson(['status_id' => 2]);
	}

	/** @test*/
	function unauthenticated_may_not_active_a_recruitment()
	{
		create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$status = create('App\Status',['type'=> 1, 'name'=>'inactive_recruitment', 'id'=>'2']);
		$recruitment = create('App\Recruitment', ['status_id'=>$status->id]);
		
		$this->get('/admin/recruitments/active/'.$recruitment->id)->assertRedirect('/admin/login');
	}

	/** @test*/
	function unauthenticated_may_not_unactive_a_recruitment()
	{
		create('App\Status',['type'=> 1, 'name'=>'inactive_recruitment', 'id'=>'2']);
		$status = create('App\Status',['type'=> 1, 'name'=>'active_recruitment', 'id'=>'1']);
		$recruitment = create('App\Recruitment', ['status_id'=>$status->id]);
		
		$this->get('/admin/recruitments/active/'.$recruitment->id)->assertRedirect('/admin/login');
	}

	/** @test */
	function a_recruitment_requires_a_title()
	{   
		$this->publishRecruitment(['title'=>null])
		->assertSessionHasErrors('title');
	}

	/** @test */
	function a_recruitment_requires_a_salary()
	{   
		$this->publishRecruitment(['salary'=>null])
		->assertSessionHasErrors('salary');
	}

	/** @test */
	function a_recruitment_requires_a_expire_date()
	{   
		$this->publishRecruitment(['expire_date'=>null])
		->assertSessionHasErrors('expire_date');
	}

	/** @test */
	function a_recruitment_requires_a_valid_category()
	{   
		$recruitment = make('App\Recruitment',
			['company_id'=>$this->company->id, 'title'=>'Tuyển dụng Senior PHP','salary'=>'7.000.000VNĐ']);
		$category = create('App\Category');

		$tmp = $recruitment->toArray();
		$tmp['category_id'][] = 3;

		//dd($tmp);

		$this->withExceptionHandling()->actingAs($this->representative->account);
		  //create with null category
		$this->post('/representative/recruitments', $recruitment->toArray())
		->assertSessionHasErrors('category_id');

		 //create with category invalid
		$this->post('/representative/recruitments', $tmp)
		->assertSessionHasErrors('category_id');
	}

	public function publishRecruitment($overrides = [])
	{
		$this->withExceptionHandling()->actingAs($this->representative->account);

		$thread = make('App\Recruitment', $overrides);

		return $this->post('/representative/recruitments', $thread->toArray());
	}


}
