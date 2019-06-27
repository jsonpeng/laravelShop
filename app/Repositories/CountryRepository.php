<?php

namespace App\Repositories;

use App\Models\Country;
use InfyOm\Generator\Common\BaseRepository;

use Cache;
use Config;

/**
 * Class CountryRepository
 * @package App\Repositories
 * @version April 2, 2018, 3:17 pm CST
 *
 * @method Country findWithoutFail($id, $columns = ['*'])
 * @method Country find($id, $columns = ['*'])
 * @method Country first($columns = ['*'])
*/
class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'sort'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Country::class;
    }

    public function countries()
    {
        return Country::orderBy('sort', 'desc')->orderBy('created_at', 'desc')->get();
    }

    public function countriesCached()
    {
        return Cache::remember('countries', Config::get('web.cachetime'), function(){
            return  $this->countries();
        });
    }

    public function countriesArray()
    {
        $countries = $this->countries()->toArray();
        $arrayCountry = array(null => '无产地');
        while (list($key, $val) = each($countries)) {
            $arrayCountry[$val['id']] = $val['name'];
        }
        return $arrayCountry;
    }
}
