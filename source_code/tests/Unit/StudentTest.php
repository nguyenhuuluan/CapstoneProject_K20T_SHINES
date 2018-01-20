<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentTest extends TestCase
{
   use DatabaseMigrations;
	public function setUp(){
		parent::setUp();
		$status = create('App\Status',['type'=> 3, 'name'=>'active_account', 'id'=>'5']);
		$this->student = create('App\Student');
	}

	/** @test */
	function it_has_account(){
		$this->assertInstanceOf('App\Account', $this->student->account);
	}

	/** @test */
	function it_has_faculty(){
		$this->assertInstanceOf('App\Faculty', $this->student->faculty);
	}

	/** @test */
     function it_has_tags(){
        $tag = create('App\Tag');
        $this->student->tags()->save($tag);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->student->tags);
    }
}
