<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhoneNumbersTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    CONST VALIDATOR = [
        'Cameroon' => [
            'code'    => '+237',
            'valid'   => '(237) 677046616',
            'invalid' => '(237) 6A0311634',
        ],
        'Ethiopia' => [
            'code'    => '+251',
            'valid'   => '(251) 912345678',
            'invalid' => '(251) 12340056',
        ],
        'Morocco' => [
            'code'    => '+212',
            'valid'   => '(212) 912345678',
            'invalid' => '(212) 1278409',
        ],
        'Mozambique' => [
            'code'    => '+258',
            'valid'   => '(258) 28123456',
            'invalid' => '(258) 9988774456',
        ],
        'Uganda' => [
            'code'    => '+256',
            'valid'   => '(256) 123456789',
            'invalid' => '(256) 01935',
        ]
    ];

    public function test_visit_phone_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_list_all_phones()
    {
        $countries = [];
        foreach(self::VALIDATOR as $country => $data)
        {            
            array_push($countries, $country);
            Customer::create(['name' => $this->faker->name, 'phone' => $data['valid']]);
            $number = explode(' ', $data['valid']);
            
            $this->get('/')
                ->assertSee($country)
                ->assertSee($countries[array_rand($countries)])
                ->assertSee($data['code'])
                ->assertSee($number[1]);
        }

    }

    public function test_filter_by_country()
    {
        $countries = [];
        foreach(self::VALIDATOR as $country => $data)
        {
            array_push($countries, $data['code']);
            Customer::create(['name' => $this->faker->name, 'phone' => $data['valid']]);
            $number = explode(' ', $data['valid']);
            
            $other_country = $countries[array_rand($countries)];
            if($other_country === $data['code']) {
                $other_country = 'TEST0000';
            }

            $this->call('GET', '/', ['country' => $country])
                ->assertSee($country)
                ->assertDontSee($other_country)
                ->assertSee($data['code'])
                ->assertSee($number[1]);
        }
    }

    public function test_filter_by_state()
    {
        foreach(self::VALIDATOR as $country => $data)
        {
            Customer::insert([
                ['name' => $this->faker->name, 'phone' => $data['valid']],
                ['name' => $this->faker->name, 'phone' => $data['invalid']]
            ]);
            
            $valid_number = explode(' ', $data['valid']);
            $invalid_number = explode(' ', $data['invalid']);
                
            $this->call('GET', '/', ['country' => $country, 'state' => 'OK'])
                ->assertSee($country)
                ->assertSee($data['code'])
                ->assertSee($valid_number[1])
                ->assertDontSee($invalid_number[1]);
        }
    }
}
