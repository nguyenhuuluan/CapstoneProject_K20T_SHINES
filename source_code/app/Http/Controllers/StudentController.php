<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
class StudentController extends Controller
{

    public function register(Request $request)
    {   

        $validatedData = $request->validate([
        'email' => 'required',

    ]);
    }

}
