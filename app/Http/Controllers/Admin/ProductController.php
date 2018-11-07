<?php

namespace App\Http\Controllers\Admin;

use App\CartDetail;
use App\Http\Controllers\Controller;

use App\ProductImage;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); // listado
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
    	return view('admin.products.create')->with(compact('categories')); // formulario de registro
    }

    public function store(Request $request)
    {
        // validar
        $messages = [
            'name.required' => 'É necessário informar um nome para o produto.',
            'name.min' => 'O nome do produto deve ter no mínimo 3 caracteres.',
            'description.required' => 'A descrição resumida é um campo obrigatório.',
            'description.max' => 'A descrição resumida comporta no máximo 200 caracteres.',
            'price.required' => 'É obrigatorio definir um preço para o produto.',
            'price.numeric' => 'Informe um preço válido.',
            'price.min' => 'Não são permitidos valores negativos.'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);

    	// registrar el nuevo producto en la bd
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->save(); // INSERT

        return redirect('/admin/products');
    }

    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product', 'categories')); // form de edición
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'É necessário informar um nome para o produto.',
            'name.min' => 'O nome do produto deve ter no mínimo 3 caracteres.',
            'description.required' => 'A descrição resumida é um campo obrigatório.',
            'description.max' => 'A descrição resumida comporta no máximo 200 caracteres.',
            'price.required' => 'É obrigatorio definir um preço para o produto.',
            'price.numeric' => 'Informe um preço válido.',
            'price.min' => 'Não são permitidos valores negativos.'

        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        // dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->save(); // UPDATE

        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        CartDetail::where('product_id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();

        $product = Product::find($id);
        $product->delete(); // DELETE

        return back();
    }

}
