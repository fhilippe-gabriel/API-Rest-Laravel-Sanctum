<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Product as ProductResource;
use App\Models\Product;
use Validator;

use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {

        $product = Product::all();
        return $this->handleResponse(ProductResource::collection($product), 'Produto Encontrado!');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:products, max:250',
            'description' => 'nullable',
            'price' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $product = Product::create($input);
        return $this->handleResponse(new ProductResource($product), 'Produto Criado');
    }
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->handleError('Produto não encontrado');
        }
        return $this->handleResponse(new ProductResource($product), 'Produto Encontrado');
    }

    // public function update(Request $request, Product $product)
    // {
    //     $input = $request->all();

    //     $validator = Validator::make($input, [
    //         'name' => 'required|unique:products, max:250',
    //         'description' => 'nullable',
    //         'price' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->handleError($validator->errors());
    //     }

    //     $product->name = $input['name'];
    //     $product->description = $input['description'];
    //     $product->save();

    //     return $this->handleResponse(new ProductResource($product), 'Prodcuto atualizado com sucesso!');
    // }
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->price = $input['price'];
        $product->save();

        return $this->handleResponse(new ProductResource($product), 'Produto atualizado com sucesso!');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->handleResponse([], 'Produto deletado');
    }
}
