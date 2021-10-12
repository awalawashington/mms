<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\User;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Facades\DB;

class RegistrationChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $user_registration = User::select([DB::raw("DATE_FORMAT(created_at, '%d-%M') as date"), DB::raw('COUNT(id) as total')])->groupBy('date')->get();
        $total = $user_registration->pluck('total')->toArray();
        $dates = $user_registration->pluck('date')->toArray();
        //$weight = User::all('weight')->pluck('weight')->toArray();
        return Chartisan::build()
            ->labels($dates)
            ->dataset('Registered Users', $total);
    }
}