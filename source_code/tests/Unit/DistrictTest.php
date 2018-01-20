<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DistrictTest extends TestCase
{
    use DatabaseMigrations;

    /**
     @test
     */
    function it_has_city(){

    	$district = create('App\District');

    	$this->assertInstanceOf('App\City', $district->city);
    }

     /**
     @test
     */
    function it_has_addresses(){

    	$district = create('App\District');
    	$address = create('App\Address', ['district_id'=>$district->id]);

    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $district->addresses);
    }
}
