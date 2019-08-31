<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Promotion;
use Validator;

class ProductPromotionController extends Controller
{

    public function store(Request $request, $product_id) {
        
        // VALIDATION OF THE DATA
        $validator = Validator::make($request->all(), [
            'promotional_price' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/products')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $promotion = new Promotion;
            $promotion->product_id = $product_id;
            $promotion->promotional_price = $request->promotional_price;
            $promotion->save();
    
            return redirect('/products');
        }
    }
}
