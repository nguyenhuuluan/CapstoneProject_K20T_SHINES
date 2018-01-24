<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRegistration extends Model
{
     protected $table = 'companies_registrations';

     protected $fillable = ['company_name', 'company_website', 'representative_name', 'representative_position', 'representative_phone', 'representative_email', 'status_id'];
}
