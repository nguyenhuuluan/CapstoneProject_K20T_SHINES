<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Account::class, function (Faker $faker) {
	//$faker->locale = "vi_VN";
	static $password;
        //'email' => $faker->unique()->safeEmail,

	return [
		'username' => $faker->userName,
		'status_id'=> 5,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Role::class, function (Faker $faker) {
	//$faker->locale = "vi_VN";
	static $password;
        //'email' => $faker->unique()->safeEmail,

	return [
		'name' => $faker->word,
	];
});


$factory->define(App\Student::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->name,
		'gender'=>rand(0,1),
		'email'=>$faker->safeEmail,
		'phone'=>$faker->e164PhoneNumber,
		'profile_photo'=>'http://placehold.it/400x400',
		'dateofbirth'=>$faker->date($format = 'Y-m-d', $max = 'now'),
		'account_id'=>function(){
			return factory('App\Account')->create()->id;
		},
		'faculty_id'=>function(){
			return factory('App\Faculty')->create()->id;
		},
	];
});

$factory->define(App\Faculty::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->word,
		'description'=>$faker->sentence,
	];
});

$factory->define(App\Representative::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->name,
		'email'=>$faker->safeEmail,
		'phone'=>$faker->e164PhoneNumber,
		'account_id'=>function(){
			return factory('App\Account')->create()->id;
		},
		'company_id'=>function(){
			return factory('App\Company')->create()->id;
		},
	];
});

$factory->define(App\Staff::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->name,
		'email'=>$faker->safeEmail,
		'phone'=>$faker->e164PhoneNumber,
		'account_id'=>function(){
			return factory('App\Account')->create()->id;
		},
	];
});


$factory->define(App\Status::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->word,
		'type'=>rand(1,3),
	];
});
$factory->define(App\Category::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->locale,
	];
});

$factory->define(App\Section::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'title'=>$faker->word,
	];
});


$factory->define(App\Recruitment::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'title'=>$faker->sentence,
		'salary'=>'8.000.000VNĐ - 15.000.000VNĐ',
		'expire_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
		'is_hot'=>0,
		'status_id'=> 1,
		'company_id'=>function(){
			return factory('App\Company')->create()->id;
		},
	];
});

$factory->define(App\Blog::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'title'=>$faker->locale,
		'content'=>$faker->locale,
		'account_id'=>function(){
			return factory('App\Account')->create()->id;
		},
	];
});


$factory->define(App\Company::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->company,
		'website'=>$faker->domainName,
		'email'=>$faker->companyEmail,
		'phone'=>$faker->tollFreePhoneNumber,
		'working_day'=>'Monday - Saturday',
		'status_id'=>function(){
			return factory('App\Status')->create()->id;
		},

	];
});

$factory->define(App\Address::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'address'=>$faker->address,
		'latitude'=>$faker->latitude($min = -90, $max = 90),
		'longtitude'=>$faker->longitude($min = -180, $max = 180),
		'company_id'=>function(){
			return factory('App\Company')->create()->id;
		},
		'district_id'=>function(){
			return factory('App\District')->create()->id;
		},
	];
});

$factory->define(App\District::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->streetName,
		'city_id'=>function(){
			return factory('App\City')->create()->id;
		},
	];
});

$factory->define(App\City::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->city,
		'country_id'=>function(){
			return factory('App\Country')->create()->id;
		},
	];
});

$factory->define(App\Country::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->country,
	];
});

$factory->define(App\Cv::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->sentence,
		'file'=>'/cv/cv1.pdf',
		'student_id'=>function(){
			return factory('App\Student')->create()->id;
		},
	];
});

$factory->define(App\Tag::class, function(Faker $faker){
	//$faker->locale = "vi_VN";
	return [
		'name'=>$faker->sentence,
	];
});



