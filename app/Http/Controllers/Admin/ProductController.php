<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->paginate();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $product = Product::query()->create([
                'name'        => data_get($data, 'name'),
                'price'       => data_get($data, 'price'),
                'sales_price' => data_get($data, 'sales_price'),
                'description' => data_get($data, 'description'),
            ]);

            $product->stocks()->create([
                'size'     => data_get($data, 'size'),
                'colour'   => data_get($data, 'colour'),
                'quantity' => data_get($data, 'quantity'),
            ]);
        });

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->load('stocks');

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {

            $data = $request->validated();

            return info($data);

            $product->update([
                'name'        => data_get($data, 'name'),
                'price'       => data_get($data, 'price'),
                'sales_price' => data_get($data, 'sales_price'),
                'description' => data_get($data, 'description'),
            ]);

            $product->stocks()->update([
                'size'     => data_get($data, 'size'),
                'colour'   => data_get($data, 'colour'),
                'quantity' => data_get($data, 'quantity'),
            ]);
        });

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
