<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['class', 'section'])->studentsQuery();
        $paginate = request('paginate');

        if (isset($paginate)) {
            $students = $students->paginate($paginate);
        } else {
            $students = $students->get();
        }

        return StudentResource::collection($students);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }

    public function massDestroy($students)
    {
        $studentsArray = explode(',', $students);
        Student::whereKey($studentsArray)->delete();
        return response()->noContent();
    }

    public function export($students)
    {
        $studentsArray = explode(',', $students);
        return (new StudentsExport($studentsArray))->download('students.xlsx');
    }

}
