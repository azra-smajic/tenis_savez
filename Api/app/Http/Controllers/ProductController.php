<?php

namespace App\Http\Controllers;
use App\Models\Product;

use App\Models\Helpers\BaseSearchObject;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function find(Request $request)
    {
        $searchObj = BaseSearchObject::fromRequest($request);

        return Product::paginate(
            $searchObj->getPageSize(),
            ['*'], 
            'page', 
            $searchObj->getPageNumber()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'slug' => 'required',
           'price' => 'required'
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Product::destroy($id);
    }

    /**
     * Search by name
     */
    public function search($name)
    {
        return Product::where('name','like', '%'.$name.'%')->get();
    }
}
