<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyProduction;
use App\Models\User;
use App\Models\TrainingNeed;
use App\Models\LeaveRequest;
use App\Models\Outsource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Hamcrest\Core\HasToString;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\AddEmployee;

class SupervisorController extends Controller
{
    //supervisor dashboard
    public function supervisorDash()
    {
        /*$outsources = Outsource::where('isActive', 1)->get('workerId');
        foreach ($outsources as $item) {
            $workerId = $item->workerId;
        }*/

        $presentEmployee = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('presentEmployees');

        $absentEmployee = DailyProduction::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('absentEmployees');

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

        $trainingNeed = TrainingNeed::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->distinct()
            ->count('employeeId');

        $leaveRequest = LeaveRequest::where('isActive', 1)
            ->where(
                'updated_at',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->distinct()
            ->count('employeeId');

        $coverAmount = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('coverAmount');

        $frameAmount = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('frameAmount');

        $threadAmount = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('threadAmount');

        $expectedUmbrella = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('expectedUmbrella');

        $rejectedUmbrella = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('rejectedUmbrella');

        return view(
            'supervisor.supervisorDashboard',
            compact([
                'presentEmployee',
                'absentEmployee',
                'totalProduction',
                'damageCount',
                'trainingNeed',
                'leaveRequest',
                'coverAmount',
                'frameAmount',
                'threadAmount',
                'expectedUmbrella',
                'rejectedUmbrella',
            ])
        );
    }

    //view daily productions
    public function dailyProduction()
    {
        $data = DailyProduction::where('isActive', 1)->get();

        $supervisor = User::where('isActive', 1)
            ->where('role', '=', 'Supervisor')
            ->select('empId')
            ->get();

        return view(
            'supervisor.dailyProduction',
            compact(['data', 'supervisor'])
        );
    }

    //add daily productions
    public function addDailyProduction(Request $request)
    {
        $dailyProductionId = Str::random(7);

        if (
            DailyProduction::where(
                'dailyProductionId',
                '=',
                $dailyProductionId
            )->exists()
        ) {
            $dailyProductionId = Str::random(7);
        }

        if (
            DailyProduction::where('unit', '=', $request->unit)
            ->where('date', '=', Carbon::now()->toDateString())
            ->exists()
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'This unit is already added. you can not add the same unit on the same day, but you can update properties related to that unit.'
                );
        }

        $dailyProduction = new DailyProduction();

        $dailyProduction->dailyProductionId = $dailyProductionId;
        $dailyProduction->unit = $request->unit;
        $dailyProduction->date = $request->date;
        $dailyProduction->empId = $request->empId;
        $dailyProduction->presentEmployees = $request->presentEmployees;
        $dailyProduction->absentEmployees = $request->absentEmployees;
        $dailyProduction->totalProduction = $request->totalProduction;
        $dailyProduction->damageCount = $request->damageCount;
        $dailyProduction->mealExpenses = $request->mealExpenses;
        $dailyProduction->isActive = 1;

        $dailyProduction->save();

        return redirect()
            ->back()
            ->with('message', 'Daily Product Added Successfully');
    }

    //update daily production
    public function editDailyProduction(Request $request)
    {
        $dailyProductionId = $request->dailyProductionId;

        DailyProduction::where([
            'dailyProductionId' => $dailyProductionId,
        ])->update([
            'unit' => $request->unit,
            'date' => $request->date,
            'empId' => $request->empId,
            'presentEmployees' => $request->presentEmployees,
            'absentEmployees' => $request->absentEmployees,
            'totalProduction' => $request->totalProduction,
            'damageCount' => $request->damageCount,
            'mealExpenses' => $request->mealExpenses,
        ]);
        return redirect()
            ->back()
            ->with('message', 'Daily Production Edited');
    }

    //delete daily production
    public function deleteDailyProduction($dailyProductionId)
    {
        DailyProduction::where([
            'dailyProductionId' => $dailyProductionId,
        ])->update([
            'isActive' => 0,
        ]);
        return redirect()
            ->back()
            ->with('error', 'Daily Production Deleted');
    }

    //get USers
    public function GetUsers(Request $request)
    {
        $data = DB::table('add_employees')
            //->join('training_needs', 'training_needs.employeeId', '=', 'users.empId')
            ->where('employeeId', '=', $request->employeeId)
            ->select('add_employees.*')
            ->get();

        return json_encode($data);
    }

    //view training requirements
    public function trainingRequirement()
    {
        $data = TrainingNeed::where('isActive', 1)->get();

        $employee = AddEmployee::where('isActive', 1)
            //->where('role', '=', 'Supervisor')
            ->select('employeeId')
            ->get();

        return view(
            'supervisor.trainingRequirement',
            compact(['data', 'employee'])
        );
    }

    //add training requirements
    public function addTrainingRequirement(Request $request)
    {
        $trainingNeed = new TrainingNeed();

        $trainingNeed->unit = $request->unit;
        $trainingNeed->date = $request->date;
        $trainingNeed->employeeId = $request->employeeId;
        $trainingNeed->employeeName = $request->employeeName;
        $trainingNeed->isActive = 1;

        $trainingNeed->save();

        return redirect()
            ->back()
            ->with('message', 'Training Need Added Successfully');
    }

    //delete daily production
    public function deleteTrainingRequirement($id)
    {
        TrainingNeed::where(['id' => $id])->update([
            'isActive' => 0,
        ]);
        return redirect()
            ->back()
            ->with('error', 'Training Requirement Deleted');
    }

    //view leaves request
    public function leaveRequest()
    {
        $data = LeaveRequest::where('isActive', 1)->get();

        $employee = AddEmployee::where('isActive', 1)
            //->where('role', '=', 'Supervisor')
            ->select('employeeId')
            ->get();
        return view('supervisor.leaves', compact(['data', 'employee']));
    }

    //add leave request
    public function addLeaveRequest(Request $request)
    {
        $LeaveRequest = new LeaveRequest();

        $LeaveRequest->unit = $request->unit;
        $LeaveRequest->date = $request->date;
        $LeaveRequest->employeeId = $request->employeeId;
        $LeaveRequest->employeeName = $request->employeeName;
        $LeaveRequest->leaveType = $request->leaveType;
        $LeaveRequest->isActive = 1;

        $LeaveRequest->save();

        return redirect()
            ->back()
            ->with('message', 'Leave Request Added Successfully');
    }

    //delete leave request
    public function deleteLeaveRequest($id)
    {
        LeaveRequest::where(['id' => $id])->update([
            'isActive' => 0,
        ]);
        return redirect()
            ->back()
            ->with('error', 'Leave Request Data Deleted');
    }

    //view outsources
    public function outsource()
    {
        $data = Outsource::where('isActive', 1)->get();

        return view('supervisor.outsourceOrders', compact(['data']));
    }

    //add outsources
    public function addOutsource(Request $request)
    {
        $this->validate($request, [
            'workerId' => 'unique:outsources',
        ]);

        $outsource = new Outsource();

        $outsource->type = $request->type;
        $outsource->workerName = $request->workerName;
        $outsource->workerId = $request->Input(['workerId']);
        $outsource->date = $request->date;
        $outsource->umbrellaCode = $request->umbrellaCode;
        $outsource->coverAmount = $request->coverAmount;
        $outsource->frameAmount = $request->frameAmount;
        $outsource->threadAmount = $request->threadAmount;
        $outsource->expectedUmbrella = $request->expectedUmbrella;
        $outsource->rejectedUmbrella = $request->rejectedUmbrella;
        $outsource->isActive = 1;

        $outsource->save();

        return redirect()
            ->back()
            ->with('message', 'outsources Added Successfully');
    }

    //update daily production
    public function editOutsource(Request $request)
    {
        $workerId = $request->workerId;

        Outsource::where([
            'workerId' => $workerId,
        ])->update([
            'type' => $request->type,
            'workerName' => $request->workerName,
            'workerId' => $request->workerId,
            'date' => $request->date,
            'umbrellaCode' => $request->umbrellaCode,
            'coverAmount' => $request->coverAmount,
            'frameAmount' => $request->frameAmount,

            'threadAmount' => $request->threadAmount,
            'expectedUmbrella' => $request->expectedUmbrella,
            'rejectedUmbrella' => $request->rejectedUmbrella,
        ]);
        return redirect()
            ->back()
            ->with('message', 'Outsource Edited');
    }

    //delete leave request
    public function deleteOutsource($id)
    {
        Outsource::where(['id' => $id])->update([
            'isActive' => 0,
        ]);
        return redirect()
            ->back()
            ->with('error', 'Outsource Data Deleted');
    }
}