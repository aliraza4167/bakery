<?php

namespace App\Http\Controllers;

use App\product;
use Validator;
use App\promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProductController extends Controller
{

    public function promotion() {
        return $this->belongsTo(Promotion::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = product::where('user_id', auth()->id())->get();

        return view('products', [
            'products'=> auth()->user()->products()->get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createProducts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // VALIDATION OF THE DATA
        $validator = Validator::make($request->all(), [
            'productName' => 'required|max:255',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required'
        ]);

        $imageName = time() . '.' . $request->filename;

        if($request->hasFile("filename")) {
            $imageName = time().'.'.$request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path().'/images/', $imageName);
        } 

        if ($validator->fails()) {
            return redirect('products/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $product = new Product;
        $product->user_id = auth()->id();
        $product->product_name = $request->productName;
        $product->image_url = $imageName;
        $product->dollar_amount = $request->price;

        $saved = $product->save();

        if($saved) {
            return redirect('/products');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $this->authorize('edit', $product);
        return view('forms.editProduct', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $this->authorize('update', $product);
        // Validate the data like in create method
        $validator = Validator::make($request->all(), [
            'productName' => 'required|max:255',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required'
        ]);

        $imageName = time() . '.' . $request->filename;

        if($request->hasFile("filename")) {
            // Delete old image before uploading a new one
            @unlink(public_path().'/images/'.$product->image_url);
            $imageName = time().'.'.$request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path().'/images/', $imageName);
        } else {
            $imageName = $product->image_url;
        }

        if ($validator->fails()) {
            return redirect('products/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // $product = new Product;
        $product->user_id = auth()->id();
        $product->product_name = $request->productName;
        $product->image_url = $imageName;
        $product->dollar_amount = $request->price;

        $saved = $product->save();

        if($saved) {
            return redirect('/products');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $this->authorize('update', $product);
        @unlink(public_path().'/images/'.$product->image_url);
        $product->delete();
        $product->promotion->delete();

        return redirect('/products');
    }
}
