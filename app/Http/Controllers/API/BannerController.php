<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\BannerRepository;

class BannerController extends Controller
{
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    public function banners($slug)
    {
    	$banner = $this->bannerRepository->getBannerCached($slug);
    	return ['status_code' => 0, 'data' => $banner];
    }
}
