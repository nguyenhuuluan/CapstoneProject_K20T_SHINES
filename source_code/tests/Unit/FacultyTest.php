<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FacultyTest extends TestCase
{
	use DatabaseMigrations;
 use DatabaseMigrations;
 public function setUp(){
    parent::setUp();
    $this->faculty= create('App\Faculty');
}
    /**
     @test
     */
     function it_has_students(){

         $student = create('App\Student', ['faculty_id'=>$this->faculty->id]);
    	//dd($faculty);
         $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->faculty->students);
     }

     /** @test */
     function it_has_tags(){
        $tag = create('App\Tag');
        $this->faculty->tags()->save($tag);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->faculty->tags);
    }
}
