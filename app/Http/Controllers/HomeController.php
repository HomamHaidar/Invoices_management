<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //=================احصائية نسبة تنفيذ الحالات======================



      $count_all =invoices::count();
      $count_invoices1 = invoices::where('Value_Status', 1)->count();
      $count_invoices2 = invoices::where('Value_Status', 2)->count();
      $count_invoices3 = invoices::where('Value_Status', 3)->count();

      if($count_invoices2 == 0){
          $nspainvoices2=0;
      }
      else{
          $nspainvoices2 = $count_invoices2/ $count_all*100;
      }

        if($count_invoices1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_invoices1/ $count_all*100;
        }

        if($count_invoices3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_invoices3/ $count_all*100;
        }

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->datasets([
                [
                    'backgroundColor' => ['#3EC70B', '#CF0A0A','#FFD93D'],
                    'data' => [round($nspainvoices1,2) ,round($nspainvoices2,2),round($nspainvoices3,2)]
                ]
            ])
            ->datasets([
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#03C988'],
                    'data' => [round($nspainvoices1,2)]
                ],
                [
                    "label" => " غير المدفوعة",
                    'backgroundColor' => ['#FF6969'],
                    'data' => [round($nspainvoices2,2)]
                ] ,
                [
                    "label" => " المدفوعة جزئيا",
                    'backgroundColor' => ['#FFD93D'],
                    'data' => [round($nspainvoices3,2)]
                ]
            ])
            ->options([]);
        $chartjs2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' =>600, 'height' => 411])
            ->labels(['الفواتير المدفوعة', 'الفواتير غير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#3EC70B', '#ED2B2A','#FFD93D'],
                    'hoverBackgroundColor' => ['#38E54D', '#FF6969','#FFED00'],
                    'data' => [round($nspainvoices1,2) ,round($nspainvoices2,2),round($nspainvoices3,2)]
                ]
            ])
            ->options([]);


        return view('home', compact('chartjs','chartjs2'));


    }


}
