<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Hamcrest\Core\HasToString;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\AddEmployee;
use App\Models\TrainingNeed;
use App\Models\Outsource;
use App\Models\LeaveRequest;

class HrController extends Controller
{
    //hr dashboard
    public function hrDashboard()
    {
        $activeEmployees = AddEmployee::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->distinct()
            ->count('randomEmpId');

        $inactiveEmployees = AddEmployee::where('isActive', 0)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->distinct()
            ->count('randomEmpId');

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

        $outLabours = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->distinct()
            ->count('id');

        $expectedUmbrella = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('expectedUmbrella');

        $rejectUmbrella = Outsource::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('rejectedUmbrella');


        return view('hrDepartment.hrDashboard', compact(['activeEmployees', 'inactiveEmployees', 'trainingNeed', 'outLabours', 'expectedUmbrella', 'rejectUmbrella']));
    }

    //employee Management
    public function employeeManagement()
    {
        $data = AddEmployee::where('isActive', '=', 1)->get();

        return view('hrDepartment.employeeManagement', compact(['data']));
    }

    //add new employee
    public function addNewEmployee(Request $request)
    {
        $randomEmpId = Str::random(7);

        if (AddEmployee::where('randomEmpId', '=', $randomEmpId)->exists()) {
            $randomEmpId = Str::random(7);
        }

        $this->validate($request, [
            'employeeId' => 'unique:add_employees',
            'nicNo' => 'max:10|unique:add_employees',
        ]);

        $newEmployee = new AddEmployee();

        $newEmployee->randomEmpId = $randomEmpId;
        $newEmployee->date = $request->date;
        $newEmployee->firstName = $request->firstName;
        $newEmployee->surname = $request->surname;
        $newEmployee->fullName = $request->fullName;
        $newEmployee->middleName = $request->middleName;
        $newEmployee->gender = $request->gender;

        $newEmployee->title = $request->title;
        $newEmployee->maritalStatus = $request->maritalStatus;
        $newEmployee->bloodGroup = $request->bloodGroup;
        $newEmployee->dateOfBirth = $request->dateOfBirth;
        $newEmployee->nationality = $request->nationality;

        $newEmployee->noOfChildren = $request->noOfChildren;
        $newEmployee->livingStatus = $request->livingStatus;
        $newEmployee->employeeId = $request->Input(['employeeId']);
        $newEmployee->nicNo = $request->Input(['nicNo']);
        $newEmployee->epfNo = $request->epfNo;

        $newEmployee->department = $request->department;
        $newEmployee->unit = $request->unit;
        $newEmployee->designation = $request->designation;
        $newEmployee->isActive = 1;

        $newEmployee->save();

        return redirect()
            ->back()
            ->with('message', 'New Employee Added Successfully');
    }

    //update employee
    public function editEmployee(Request $request)
    {
        $randomEmpId = $request->randomEmpId;

        AddEmployee::where([
            'randomEmpId' => $randomEmpId,
        ])->update([
            'date' => $request->date,
            'firstName' => $request->firstName,
            'surname' => $request->surname,
            'fullName' => $request->fullName,
            'middleName' => $request->middleName,
            'gender' => $request->gender,
            'title' => $request->title,
            'maritalStatus' => $request->maritalStatus,

            'bloodGroup' => $request->bloodGroup,
            'dateOfBirth' => $request->dateOfBirth,
            'nationality' => $request->nationality,
            'noOfChildren' => $request->noOfChildren,
            'livingStatus' => $request->livingStatus,

            'epfNo' => $request->epfNo,
            'department' => $request->department,
            'unit' => $request->unit,
            'designation' => $request->designation,
        ]);
        return redirect()
            ->back()
            ->with('message', 'Employee Update Successfully.');
    }

    //delete employee
    public function deleteEmployee($randomEmpId)
    {
        AddEmployee::where([
            'randomEmpId' => $randomEmpId,
        ])->update([
            'isActive' => 0,
        ]);
        return redirect()
            ->back()
            ->with('error', 'Employee Deleted');
    }

    //employee profile
    public function viewProfile()
    {
        return view('hrDepartment.profileView');
    }

    //service search
    public function searchEmployee(Request $request)
    {
        $employee = AddEmployee::where('isActive', '=', '1')
            ->where(
                'employeeId',
                'like',
                '%' . $request->get('searchText') . '%'
            )
            ->orWhere(
                'fullName',
                'like',
                '%' . $request->get('searchText') . '%'
            )
            ->get();

        return json_encode($employee);
    }

    //inactive profile
    public function inactiveProfile()
    {
        $data = AddEmployee::where('isActive', '=', 0)->get();
        return view('hrDepartment.inactiveProfile', compact(['data']));
    }

    //inactive profile delete
    public function deleteInactiveProfile($id)
    {
        AddEmployee::find($id)->delete();

        return redirect()
            ->back()
            ->with('error', 'Inactive Employee Deleted');
    }

    //view training requirements
    public function hrTrainingRequirement()
    {
        $data = DB::table('training_needs')
            ->join(
                'add_employees',
                'add_employees.employeeId',
                '=',
                'training_needs.employeeId'
            )
            ->select('training_needs.*', 'add_employees.*')
            ->get();

        return view('hrDepartment.employeeTrainingReq', compact(['data']));
    }


    //view outsources performance
    public function outsourceEvaluation()
    {
        $data = Outsource::where('isActive', 1)->where(
            'date',
            '>=',
            Carbon::now()
                ->subDays(30)
                ->toDateTimeString()
        )->get();

        return view('hrDepartment.outlaboursEvaluation', compact(['data']));
    }

    //view leaves request
    public function leaveRequestEmployees()
    {
        $data = LeaveRequest::where('isActive', 1)->get();

        $employee = AddEmployee::where('isActive', 1)
            //->where('role', '=', 'Supervisor')
            ->select('employeeId')
            ->get();
        return view('hrDepartment.leaveNeedEmployees', compact(['data', 'employee']));
    }
}
