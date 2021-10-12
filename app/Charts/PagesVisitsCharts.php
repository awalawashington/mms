<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Visitor;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Facades\DB;

class PagesVisitsCharts extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $user_registration = Visitor::select([DB::raw("DATE_FORMAT(created_at, '%d-%M') as date"), DB::raw('COUNT(id) as total'), DB::raw('page_id')])->groupBy('date')->groupBy('page_id')->get();
        $user_registration_dates = Visitor::select([DB::raw("DATE_FORMAT(created_at, '%d-%M') as date")])->groupBy('date')->get();
        $login = $user_registration->where('page_id', 1)->pluck('total')->toArray();
        $register = $user_registration->where('page_id', 2)->pluck('total')->toArray();
        $home = $user_registration->where('page_id', 6)->pluck('total')->toArray();
        $dates = $user_registration_dates->pluck('date')->toArray();
        //$weight = User::all('weight')->pluck('weight')->toArray();
        return Chartisan::build()
            ->labels($dates)
            ->dataset('Login Page', $login)
            ->dataset('Register Page', $register)
            ->dataset('Home Page', $home);
    }
}