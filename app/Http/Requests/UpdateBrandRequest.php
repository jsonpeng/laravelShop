<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Brand;

class UpdateBrandRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Brand::$rules;
        //解决unique update出现的问题
        $brand_id = (int)$this->brand_id;
        $old_brand = Brand::where('id', $brand_id)->first();      
        
        //如果unique字段未更改，则进行处理
        if($old_brand->name == $this->name){
            $rules['name'] = $rules['name'].',name,'.$brand_id;
        } 

        return $rules;
    }
}
