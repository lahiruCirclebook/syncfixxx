<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Hamcrest\Core\HasToString;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\DailyProduction;

class productionManagerController extends Controller
{
    //production manager dashboard
    public function dashboard()
    {
        $totalProduction = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('totalProduction');

        $damageCount = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('damageCount');
        $noOfUnit = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->distinct()
            ->count('unit');

        $mealExpenses = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('mealExpenses');

        return view(
            'productionManager.productionManagerDashboard',
            compact([
                'totalProduction',
                'damageCount',
                'noOfUnit',
                'mealExpenses',
            ])
        );
    }

    //Efficiency and Status
    public function efficiencyStatus()
    {
        $data = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->get();

        return view('productionManager.efficiencyAndStatus', compact(['data']));
    }

    //filter product report
    public function filterEfficiencyStatus(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $data = DailyProduction::where('isActive', '=', 1)
            ->whereBetween('date', [$fromDate, $toDate])
            ->get();

        return view(
            'productionManager.filterEfficiencyAndStatus',
            compact(['data', 'fromDate', 'toDate'])
        );
    }

    //chart demonstration
    public function chartDemonstration()
    {
        $date = null;
        $totalProduction = DailyProduction::selectRaw(
            '(unit) as x, (totalProduction) as y'
        )
            //->groupBy('x')
            ->where('date', '=', Carbon::now()->toDateString())
            ->distinct('unit')
            ->get();

        $damageCount = DailyProduction::selectRaw(
            '(unit) as x, (damageCount) as y'
        )
            //->groupBy('x')
            ->where('date', '=', Carbon::now()->toDateString())
            ->distinct('unit')
            ->get();

        $dates = DailyProduction::where(
            'date',
            '=',
            Carbon::now()->toDateString()
        )
            ->select('date')
            ->get();

        foreach ($dates as $item) {
            $date = $item->date;
        }

        return view(
            'productionManager.chartDemonstration',
            compact(['totalProduction', 'damageCount', 'date'])
        );
    }
}
