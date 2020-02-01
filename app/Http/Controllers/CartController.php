<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Carbon\Carbon;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
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
                        'user_id' => $user->id,
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
                        'user_id' => $user->id,
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

        return view('admin.carts.index')->with(compact('carts','count','subtotal','sisas','hitung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pesen = [];
        //dd($pesen);

        foreach ($request->pesen as $val) {

            $product = Product::with('Unit.Category')->find($val);
            //dd($product);
            
            $pesen[] = [
                'id' => $product->id,
                'name' => $product->name,
                'stok' => $product->stok,
                'unit' => $product->unit->name,
                'category' => $product->unit->category->name
            ];

        }

        return view('admin.carts.add', compact('pesen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $sisas = Product::find($request->pesen[2]['id']);
        if ($sisas->stok <= $request->pesen[2]['qty']) {

            return redirect()->route('carts.index')->with('alert', 'Silahkan Approve ke Admin');

        }else{

            foreach ($request->pesen as $val) {

            $product = Product::with('Unit.Category')->find($val['id']);
            $cart = Cart::where('product_id', $val['id'])->first();
            if($cart == null){
                Cart::create([
                    'product_id' => $val['id'],
                    'qty' => $val['qty']
                ]);

            }else{

                Cart::where(['id' => $cart->id])->update([
                    'qty' => $val['qty'] + $cart->qty
                ]);
            }

            Product::where('id', $val['id'])->update([
                'stok' => $product->stok - $val['qty']
            ]);

        }

        $date = Carbon::now();

        $total = count($request->pesen);

        Log::create([
            'user_id' => Auth::user()->id,
            'activity' => $request->activity,
            'detail_activity' => $request->activity.' '.$total.' jumlah produk',
            'tanggal' => $date,
            'order_change' => 1
        ]);
        
        return redirect()->route('products.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        //dd($product);
        $cart = Cart::where('product_id', $id)->first();
        $qty = null;

        return view('admin.carts.edit', compact('product','qty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
