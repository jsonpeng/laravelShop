<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\StoreRepository;

class StoreController extends Controller
{
	private $productRepository;

	public function __construct(
        StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
    }

    public function storeWithProducts(Request $request)
    {
    	$skip = 0;
    	$take = 18;

    	if ($request->has('skip')) {
    		$skip = $request->input('skip');
    	}
    	
    	if ($request->has('take')) {
    		$take = $request->input('take');
    	}

    	$stores = $this->storeRepository->storesWithProducts($skip, $take);

    	return ['status_code' => 0, 'data' => $stores];
    }
}
