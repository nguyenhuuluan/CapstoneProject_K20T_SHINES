<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CvTest extends TestCase
{
     use DatabaseMigrations;

    /**
     @test
     */
    function it_has_country(){


    	$cv = create('App\Cv');

    	$this->assertInstanceOf('App\Student', $cv->student);
    }
}
