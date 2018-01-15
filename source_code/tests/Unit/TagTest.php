<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagTest extends TestCase
{
     use DatabaseMigrations;
	public function setUp(){
		parent::setUp();
		$this->tag = create('App\Tag');
	}

	/** @test */
	function it_has_recruitments(){
		$recruitment = create('App\Recruitment');
		$this->tag->recruitments()->save($recruitment);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->recruitments);
	}

	/** @test */
	function it_has_companies(){
		$company = create('App\Company');
		$this->tag->companies()->save($company);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->companies);
	}

	/** @test */
	function it_has_students(){
		$student = create('App\Student');
		$this->tag->students()->save($student);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->students);
	}

	/** @test */
	function it_has_blogs(){
		$blog = create('App\Blog');
		$this->tag->blogs()->save($blog);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->blogs);
	}

	/** @test */
	function it_has_faculties(){
		$faculty = create('App\Blog');
		$this->tag->faculties()->save($faculty);
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->faculties);
	}
}
