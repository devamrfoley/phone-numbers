<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\PhoneValidationService;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index(Request $request, PhoneValidationService $phoneValidationService)
    {
        $per_page = $request->per_page ?? 10;

        $paginator = Customer::select('phone')->paginate($per_page);
        $phones = $phoneValidationService->validate($paginator);
        $countries = $phoneValidationService->countries();

        return view('home', ['phones' => $phones, 'countries' => $countries, 'paginator' => $paginator]);
    }
}
