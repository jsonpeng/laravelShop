<?php

namespace App\Repositories;

use App\Models\Address;
use InfyOm\Generator\Common\BaseRepository;
use Illuminate\Support\Facades\Auth;

class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'phone',
        'province',
        'city',
        'district',
        'detail',
        'default'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Address::class;
    }

    public function getDefaultAddress()
    {
        return auth('web')->user()->addresses()->orderBy('default', 'desc')->first();
    }

    public function userDefaultAddress($user)
    {
        $address = $user->addresses()->where('default','true')->first();

        if(empty($address))
        {
            $address =  $user->addresses()->orderBy('created_at','desc')->first();
        }
        return $address;
    }
}
