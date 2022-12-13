<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Hamcrest\Core\HasToString;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class StudentController extends Controller
{
    public function studentView()
    {
        $student = Student::where('isActive', '=', 1)->get();

        return view('student', compact(['student']));
    }


    public function addStudent(Request $request)
    {
        $studentId = Str::random(7);

        if (Student::where('studentId', '=', $studentId)->exists()) {

            $studentId = Str::random(7);
        }

        $student = new Student();

        $student->studentId = $studentId;
        $student->studentName = $request->studentName;
        $student->dob = $request->dob;
        $student->address = $request->address;
        $student->isActive = 1;

        $student->save();

        return redirect()
            ->back()
            ->with('message', 'New Student Added Successfully');
    }

    public function editStudent(Request $request)
    {
        $studentId = $request->studentId;

        Student::where([
            'studentId' => $studentId,
        ])->update([
            'studentName' => $request->studentName,
            'dob' => $request->dob,
            'address' => $request->address,

        ]);
        return redirect()
            ->back()
            ->with('message', 'Student Edited');
    }

    public function deleteStudent($studentId)
    {

        Student::where([
            'studentId' => $studentId,
        ])->update([
            'isActive' => 0,
        ]);

        return redirect()
            ->back()
            ->with('error', 'Student Deleted');
    }
}
