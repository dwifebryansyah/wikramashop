<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Report;
use App\Order;
use App\Category;
use App\Cart;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ReportController extends Controller
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

    public function index()
    {

        $categories = Category::latest()->paginate(25);
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

        $dayNow = Carbon::now()->format('Y-m-d');
        $monthNow = Carbon::now()->format("Y-m");
        $weeks = Carbon::now()->format("W");
        $weekNow = Carbon::now()->format("Y").'-W'.$weeks;

        return view('admin.reports.index', compact('carts','count','subtotal','monthNow','weekNow','dayNow','sisas','hitung'));

    }


    public function create()
    {
        //
    }

    public function struk()
    {
        $order = Order::orderBy('id', 'desc')
            ->first();

        //dd('jahha');

        if($order->nama == null){

            $data = OrderDetail::with('Product.Unit')
                ->where('order_id', $order->id)->get();

            $data2 = Order::where('id', $order->id)->first();

        }else{


        }

        //dd($data2);


        return view('admin.orders.struk', compact('order','data2','data'));
    }

    public function print($id)
    {
        
        $data = Report::where('order_id', $id)->first();
        // dd($data);
        $order_details = OrderDetail::with('Product.Unit')
            ->where('order_id', $data->order_id)->get();
            
        $order = Order::where('id', $data->order_id)->first();

        $pdf = PDF::loadView('pdf.struk_pdf', compact('data','order_details','order'));

        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('Struk.pdf');
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $day = $request->day;
        $week = date_format(date_create($request->week), 'W');
        $month = date_format(date_create($request->month), 'm');
        $year = date_format(date_create($request->week), 'Y');
        $weekNow = Carbon::now()->format('W');
        $monthNow = Carbon::now()->format('m');

        if($request->jenis_laporan == 'mingguan'){

            if($request->laporan == 'barang'){

                if($week == $weekNow){

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereBetween('tanggal',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where('product_id', $gp->product_id)
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }


                    $pdf = PDF::loadView('pdf.mingguan_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }else{
                    $weekFirst = Carbon::now()->setISODate($year, $week);
                    $weekLast = Carbon::now()->setISODate($year, $week, 7);

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereBetween('tanggal', [$weekFirst, $weekLast])
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];

                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where('product_id', $gp->product_id)
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.mingguan_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }

            }else{


                //pasok
                if($week == $weekNow){
                    
                    $getReport = Report::with('Product.Unit.Category')
                        ->whereBetween('tanggal',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where([
                                ['product_id', '=' , $gp->product_id],
                                ['bm_jumlah', '<>', null]
                            ])
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.mingguan_pasok_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');


                }else{
                    
                    $weekFirst = Carbon::now()->setISODate($year, $week);
                    $weekLast = Carbon::now()->setISODate($year, $week, 7);

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereBetween('tanggal', [$weekFirst, $weekLast])
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];

                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where([
                                ['product_id', '=' , $gp->product_id],
                                ['bm_jumlah', '<>', null]
                            ])
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.mingguan_pasok_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }
            }

        }elseif($request->jenis_laporan == 'harian'){
            
            if($request->laporan == 'barang'){

                $getReport = Report::with('Product.Unit.Category')
                    ->where('tanggal',$day)
                    ->distinct('product_id')
                    ->get('product_id');

                $reports = [];
                foreach ($getReport as $gp) {
                    $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                        ->where('product_id', $gp->product_id)
                        ->orderBy('code_report', 'desc')
                        ->first();
                }

                $pdf = PDF::loadView('pdf.harian_pdf', compact('reports'));
                return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');


            }else{

                $getReport = Report::with('Product.Unit.Category')
                    ->where('tanggal',$day)
                    ->where('bm_jumlah', '<>', null)
                    ->distinct('product_id')
                    ->get('product_id');

                $reports = [];
                foreach ($getReport as $gp) {
                    $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                        ->where([
                            ['product_id', '=' , $gp->product_id],
                            ['bm_jumlah', '<>', null]
                        ])
                        ->orderBy('code_report', 'desc')
                        ->first();
                }

                $pdf = PDF::loadView('pdf.harian_pasok_pdf', compact('reports'));
                return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

            }

        }else{

            if($request->laporan == 'barang'){

                if($month == $monthNow){

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereMonth('tanggal',$monthNow)
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where('product_id', $gp->product_id)
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.bulanan_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }else{

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereMonth('tanggal',$month)
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where('product_id', $gp->product_id)
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.bulanan_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }

            }else{

                //pasok
                if($month == $monthNow){

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereMonth('tanggal',$monthNow)
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where([
                                ['product_id', '=' , $gp->product_id],
                                ['bm_jumlah', '<>', null]
                            ])
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.bulanan_pasok_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }else{

                    $getReport = Report::with('Product.Unit.Category')
                        ->whereMonth('tanggal',$month)
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.Unit.Category','Product.Supplier')
                            ->where([
                                ['product_id', '=' , $gp->product_id],
                                ['bm_jumlah', '<>', null]
                            ])
                            ->orderBy('code_report', 'desc')
                            ->first();
                    }

                    $pdf = PDF::loadView('pdf.bulanan_pasok_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }

            }

        }

        //dd($reports);

    }

    public function edit(Report $report)
    {
        //
    }


    public function update(Request $request, Report $report)
    {
        //
    }

    public function destroy(Report $report)
    {
        //
    }
}
