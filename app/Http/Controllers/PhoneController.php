<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $customers = Customer::paginate($per_page);

        return view('home', ['phones' => $customers]);
    }
}
