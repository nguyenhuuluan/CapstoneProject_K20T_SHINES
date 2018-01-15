<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BlogTest extends TestCase
{
    use DatabaseMigrations;

    /**
     @test
     */
    function it_has_owner(){
    	$blog = factory('App\Blog')->create();

    	$this->assertInstanceOf('App\Account', $blog->owner);
    }
}
