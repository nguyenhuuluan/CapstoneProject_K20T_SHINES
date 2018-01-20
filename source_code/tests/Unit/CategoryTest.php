<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
     use DatabaseMigrations;

    /**
     @test
     */
    function it_has_recruitments(){

    	$category = factory('App\Category')->create();
    	$recruitment = factory('App\Recruitment')->create();
    	$recruitment->categories()->save($category);
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->recruitments);
    }
}
