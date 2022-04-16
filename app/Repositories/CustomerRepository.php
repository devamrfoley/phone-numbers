<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Services\PhoneValidationService;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    private $limit = 1000;

    protected $phoneValidationService, $customers;

    public function __construct(Customer $customer, PhoneValidationService $phoneValidationService)
    {
        $this->phoneValidationService = $phoneValidationService;
        $this->customers = $customer->select('phone')->limit($this->limit)->get();
    }

    public function normalize(): Collection
    {
        return $this->phoneValidationService->validate($this->customers);
    }

    public function countries()
    {
        return $this->phoneValidationService->countries();
    }

    public function filter(Collection $data, array $filters): Collection
    {
        return empty($filters)? $data : $data->filter(function ($phone, $key) use($filters) {
            return (!empty($filters['country'])? $phone['country'] === $filters['country'] : true) && 
                (!empty($filters['state'])? $phone['state'] === $filters['state'] : true);
        });
    }
}