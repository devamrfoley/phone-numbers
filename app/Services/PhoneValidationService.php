<?php
namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class PhoneValidationService
{
    protected $validators, $countries;

    public function __construct()
    {
        $this->validators   = config('validation.phone');
        $this->countries    = [];
    }

    public function validate(LengthAwarePaginator $paginated_data): array
    {
        $data = [];

        foreach($paginated_data as $index => $model)
        {
            [$code, $country, $validated] = $this->match_phone_number($model->phone);

            $data[$index]['code']       = $code;
            $data[$index]['country']    = $country;
            $data[$index]['state']      = $validated;
            $data[$index]['number']     = $this->number($model->phone);
        }

        return $data;
    }

    public function countries()
    {
        return $this->countries;
    }

    protected function match_phone_number(string $phone_number): array
    {
        $code = '';
        $country = '';
        $validated = '';

        foreach($this->validators as $countryName => $validator)
        {
            if(preg_match('/'. substr($validator['regex'], 0, 10) .'/', $phone_number))
            {
                $country = $countryName;
                $code = $validator['code'];
                $validated = preg_match('/'. $validator['regex'] .'/', $phone_number)? 'OK' : 'NOK';
                if(!in_array($countryName, $this->countries)) {
                    $this->countries[] = $countryName;
                }
                break;
            }
        }
        return [$code, $country, $validated];
    }

    protected function number(string $phone_number)
    {
        $number = explode(' ', $phone_number);

        return !empty($number) ? $number[count($number) - 1] : $phone_number;
    }
}