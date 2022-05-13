<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('dashboard/products/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard/products/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {

        $image_name = null;
        if($file = $request->file('file')) {
            $name = Str::random(6) . '-' . $file->getClientOriginalName();
            $file->move('assets/images/products', $name);
            $image_name = '/assets/images/products/' . $name;
        }

        $price_final = $request->price;
        if(isset($request->offer) && $request->offer > 0){
            $price_final = $request->price - (($request->price * $request->offer) / 100);
            //dd($price_final);
        }

        $create = Product::create([
            'barcode' => (isset($request->barcode)) ? $request->barcode : str_replace(' ', '-', strtolower($request->name)) . '-' . Str::random(5),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'offer' => (isset($request->offer)) ? $request->offer : 0,
            'price_final' => $request->price,
            'stock' => $request->stock,
            'stock_alert' => $request->stock_alert,
            'has_stock_alert' => ($request->has_stock_alert == 'on') ? 1 : 0,
            'slug' => $request->slug,
            'image' => $image_name,
            'category_id' => $request->category_id
        ]);

        //dd($create);

        if($create){
            return redirect()->route('products.create')->with('success', $create->id);
        } else {
            return redirect()->route('products.create')->with('error', 'error');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard/products/show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard/products/edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'barcode' => [Rule::unique('products', 'barcode')->ignore($product->id)],
            'slug' => [Rule::unique('products', 'slug')->ignore($product->id)],
        ]);

        $image_name = $product->image;
        if($file = $request->file('file')) {
            $name = Str::random(6) . '-' . $file->getClientOriginalName();
            $file->move('assets/images/products', $name);
            $image_name = '/assets/images/products/' . $name;
            $product->image = $image_name;
        }

        $price_final = $request->price;
        if(isset($request->offer) && $request->offer > 0){
            $price_final = $request->price - (($request->price * $request->offer) / 100);
            //dd($price_final);
        }

        /**
         * Cambiarlo por el metodo convencional
         */
        $update = $product->update([
            'barcode' => (isset($request->barcode)) ? $request->barcode : str_replace(' ', '-', strtolower($request->name)) . '-' . Str::random(5),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'offer' => (isset($request->offer)) ? $request->offer : 0,
            'price_final' => $request->price,
            'stock' => $request->stock,
            'stock_alert' => $request->stock_alert,
            'has_stock_alert' => ($request->has_stock_alert == 'on') ? 1 : 0,
            'slug' => $request->slug,
            'image' => $image_name,
            'category_id' => $request->category_id
        ]);

        //dd($update);

        if($update){
            return redirect()->route('products.edit', $product->id)->with('success', $product->id);
        } else {
            return redirect()->route('products.edit')->with('error', 'error');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $destroy = $product->update([
            $product->removed = 1
        ]);

        if($destroy){
            return redirect()->route('products.index')->with('success', 'Producto enviado a papelera');
        } else {
            return redirect()->route('products.index')->with('error', 'Algo salió mal! Por favor recárgue la página para intentarlo nuevamente.');
        }
        
    }



    public function restore($id)
    {
        $product = Product::find($id);

        $destroy = $product->update([
            $product->removed = 0
        ]);

        if($destroy){
            return redirect()->route('products.index')->with('success', 'Producto restaurado');
        } else {
            return redirect()->route('products.index')->with('error', 'Algo salió mal! Por favor recárgue la página para intentarlo nuevamente.');
        }
    }
}
