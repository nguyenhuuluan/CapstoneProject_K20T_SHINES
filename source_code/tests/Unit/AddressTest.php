<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddressTest extends TestCase
{
   use DatabaseMigrations;

    /**
     @test
     */
    function it_has_company(){

    	$company = create('App\Company');
    	$address = create('App\Address',['company_id'=>$company->id]);

    	$this->assertInstanceOf('App\Company', $address->company);
    }

     /**
     @test
     */
    function it_has_district(){

    	$district = create('App\District');
    	$address = create('App\Address', ['district_id'=>$district->id]);

    	$this->assertInstanceOf('App\District', $address->district);
    }
}
