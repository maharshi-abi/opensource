<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        try{
            $products = Product::where('user_id',auth()->user()->id)->with('imageData')->latest()->paginate(10);                        
            return view('product.list',compact('products'));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'danger','message' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();        
        try{
            $validatedData = $this->validate($request, [
                'title' => 'required|min:4',
                'description' => 'required|min:10',
                'price' => 'numeric|min:1',
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif'
                ]);

            $product = Product::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                ]);

            $this->storeProductData($request,$product);
            $this->storeProductImage($request,$product);
            DB::commit();

            return redirect()->route('product.index')->with(['status' => 'success','message'=>'Product created successfully !!']);

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'danger','message' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try{
            if($product->user_id !== auth()->user()->id){
                return redirect()->back()->with(['status' => 'danger','message' => 'Product not found !!']);
            }
            $product = Product::with('allImage','allAttributes')->where('id',$product->id)->first();
            return view('product.view',compact('product'));    
        } catch (Exception $e) {            
            return redirect()->back()->with(['status' => 'danger','message' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            if($product->user_id !== auth()->user()->id){
                return redirect()->back()->with(['status' => 'danger','message' => 'Product not found !!']);            
            } 

            $product->delete();
            return redirect()->back()->with(['status' => 'success','message' => 'Product Removed successfully !!']);

        } catch (Exception $e) {            
            return redirect()->back()->with(['status' => 'danger','message' => $e->getMessage()])->withInput();
        }
    }

    public function storeProductData($request,$product){        
        if (!empty($request->attribute_name) && !empty($request->attribute_value) && !empty($product->id))  {            
            $attribute_name= $request->attribute_name;
            $attribute_value= $request->attribute_value;            
            for ($i=0; $i<count($attribute_name); $i++) {
                if (!empty($attribute_name[$i]) && !empty($attribute_value[$i])) {                                        
                    $data=array(
                        'product_id' => $product->id,
                        'attribute' => $attribute_name[$i],
                        'value' => $attribute_value[$i]
                        );                    
                    ProductAttribute::create($data);                
                }
            }                
        }
    }

    public function storeProductImage($request,$product){        
        if (!empty($request->image) && !empty($product->id))  {                                                
            foreach($request->image as $file){
                $name = time().''.rand().'.'.$file->extension();                    
                $file->move(public_path('product_image'),$name);                                        
                ProductImage::create(['product_id' => $product->id, 'image' => $name ]);                
            }            
        }
    }


}
