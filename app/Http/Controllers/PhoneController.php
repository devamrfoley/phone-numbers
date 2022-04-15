<?php
namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index(Request $request, CustomerRepository $customerRepository)
    {
        $phones     = $customerRepository->filter($customerRepository->normalize(), $request->only(['country', 'valid']));
        $countries  = $customerRepository->countries();

        return view('home', ['phones' => $phones, 'countries' => $countries]);
    }
}
