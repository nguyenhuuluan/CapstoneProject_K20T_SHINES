<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CountryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     @test
     */
    function it_has_cites(){

        $country = create('App\Country');
    	$city = create('App\City', ['country_id'=>$country->id]);

    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $country->cities);
    }
}
