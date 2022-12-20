<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Product as ProductResource;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {

        $product = Product::all();
        return $this->handleResponse(ProductResource::collection($product), 'Tasks have been retrieved!');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make(Sinput, [
            'name' => 'required',
            'descri[tion' => 'required',
            'price' => 'required',

        ]);
    }
}
