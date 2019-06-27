<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class CouponGiven extends Controller
{
    public function index()
    {
    	return view('admin.coupons.given');
    }
}
