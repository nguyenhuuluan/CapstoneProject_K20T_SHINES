<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RecruitmentTest extends TestCase
{
  use DatabaseMigrations;


  public function setUp(){
        parent::setUp();
        $status = create('App\Status',['type'=> 1]);
        $this->recruitment = create('App\Recruitment',['status_id'=>$status->id]);
    }

  /** @test */
    function a_recruitment_can_make_a_string_path(){
    	
        $this->assertEquals("/recruitments/{$this->recruitment->slug}", $this->recruitment->path());
    }

     /** @test*/
    public function a_recruitment_has_company()
    {	
        $this->assertInstanceOf('App\Company', $this->recruitment->company);
    }

     /** @test*/
    public function a_recruitment_has_status()
    {	
        $this->assertInstanceOf('App\Status', $this->recruitment->status);
    }

     /** @test*/
    public function a_recruitment_has_sections()
    {	

    	// dd($this->recruitment->sections);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->recruitment->sections);
    }

     /** @test */
     function a_recruitment_has_tags(){
        $tag = create('App\Tag');
        $this->recruitment->tags()->save($tag);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->recruitment->tags);
    }
}
