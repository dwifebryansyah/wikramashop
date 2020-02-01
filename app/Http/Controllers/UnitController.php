<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Category;
use App\Cart;
use Carbon\Traits\Units;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class UnitController extends Controller
{

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $role = $user->roles->first()->pivot->role_id;

            if ($role == 2) {
                return redirect('home/');
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
        $units = Unit::with('Category')->latest()->paginate(25);

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

        return view('admin.units.index')->with(compact('units','carts','count','subtotal','sisas','hitung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.units.add')->with(compact('categories'));
        return redirect()->route('admin.units.index')
                            ->with('Success','Berhasil Menambahkan Barang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kdUnit = Unit::select(['code_unit'])->max('code_unit');

        $noUrut = (int) substr($kdUnit, 5, 3);

        $noUrut++;
        $char = "CK";
        $kdUnit = $char . sprintf("%05s", $noUrut);

        Unit::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'code_unit' => $kdUnit,            
        ]);

        return redirect()->route('units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $categories = Category::all();
        return view('admin.units.edit', compact('unit','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        Unit::where(['id' => $unit->id])->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);


        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->back()->with('alert', 'Berhasil Hapus Data');
    }
}
