<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductController extends Controller
{

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $role = $user->roles->first()->pivot->role_id;

            if ($role == 2) {
                if($user){
                    $data = collect([
                        'name' => $user->name,
                        'email' => $user->email,
                        'id' => $user->id,
                        'role_id' => $role,
                    ]);
                    Session::put('user', $data);
                }

                return $next($request);
            }else{
                if($user){
                    $data = collect([
                        'name' => $user->name,
                        'email' => $user->email,
                        'id' => $user->id,
                        'role_id' => $role,
                    ]);
                    Session::put('user', $data);
                }

                return $next($request);
            }
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('Unit.Category')->latest()->paginate(25);

        $carts = Cart::with('Product')->paginate(15);

        $harga = [];

        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $sisas = Product::where('stok', "<=", 5)
            ->get();

        $hitung = $sisas->count();

        $subtotal = array_sum($harga);

        $count = $carts->count();

        return view('admin.products.index')->with(compact('products','carts','count','subtotal','sisas', 'hitung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $units = Unit::all();
        $categories = Category::all();

        return view('admin.products.add')->with(compact('products','units','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all())
        $kdBarang = Product::select(['code_item'])->max('code_item');

        $noUrut = (int) substr($kdBarang, 5, 3);

        $noUrut++;
        $char = "BR";
        $kdBarang = $char . sprintf("%05s", $noUrut);

        Product::create([
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'unit_id' => $request['unit_id'],
                'harga_jual' => $request['harga_jual'],
                'stok' => $request['stok'],
                'code_item' => $kdBarang,
            ]);


        $getProduct = Product::orderBy('id', 'desc')->first();

        //dd($getProduct);

        Supplier::create([
            'product_id' => $getProduct->id,
            'harga_beli' => $request['harga_beli'],
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $units = Unit::all();
        $categories = Category::all();

        return view('admin.products.edit', compact('units','categories','product'));
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
        Product::where(['id' => $product->id])->update([
            'name' => $request['name'],
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'harga_jual' => $request['harga_jual'],
            'stok' => $request['stok'],
            'code_item' => $request['code_item'],
        ]);


        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('alert', 'Berhasil Hapus Data');
    }
}
