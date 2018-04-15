<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::orderBy('id','DESC')->paginate(10);
        return view('product.index',compact('products'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //
        $this->validate( $request,[
            'productName'=>'required'
        ]);

       
        $product = new Product();

        $product->productName =$request->input('productName');
        $product->description =$request->input('description');
        
        if( $request->hasFile('photo')) {
            $image = $request->file('photo');
            $path = public_path(). '/images/';
            $filename = time() . '.' . $image->extension();
            $image->move($path, $filename);
        }
        // dd($filename);
        $product->photo=$filename;
        $product->save();
        return redirect()->route('product.index')->with('success','Successfull Add');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate( $request,[
            'productName'=>'required'
        ]);
        Product::find($id)->update($request->all());
        return redirect()->route('product.index')->with('success','Successfull Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Product::find($id)->delete();
        return redirect()->route('product.index')
                        ->with('success',' deleted successfully');
    }
}
