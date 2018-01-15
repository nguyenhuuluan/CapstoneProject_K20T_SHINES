<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CityTest extends TestCase
{
        use DatabaseMigrations;

    /**
     @test
     */
    function it_has_country(){

    	$city = create('App\City');

    	$this->assertInstanceOf('App\Country', $city->country);
    }

     /**
     @test
     */
    function it_has_districts(){

    	$city = create('App\City');
    	$district = create('App\District', ['city_id'=>$city->id]);
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $city->districts);
    }
}
