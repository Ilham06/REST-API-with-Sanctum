<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $data = StudentResource::collection($students);

        return response()->json([
            'message' => 'Daftar Mahasiswa',
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => 'required|unique:students,name',
            'nim' => 'required|unique:students,nim',
            'semester' => 'required'
        ]);
        
        if ($data->fails()) {
            return response()->json($data->errors());
        }

        $store = Student::create($request->all());

        return response()->json([
            'message'       => 'Mahasiswa Berhasil di Tambahkan.',
            'data'  => $store
        ]);
    }

    public function show($id)
    {
        $student = Student::with('course')->find($id);

        if (!$student) {
            return response()->json([
                'message'       => 'Mahasiswa Tidak di Temukan.',
            ]);
        }

        return response()->json([
            'data'  => $student
        ]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $data = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('students')->ignore($id)],
            'nim' => ['required', Rule::unique('students')->ignore($id)],
            'semester' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json($data->errors());
        }

        $student->name = $request->name;
        $student->nim = $request->nim;
        $student->semester = $request->semester;
        $student->save();

        return response()->json([
            'message'       => 'Mahasiswa Berhasil di Update.',
            'data'  => $student
        ]);
    }

    public function delete($id)
    {
        Student::destroy($id);

        return response()->json([
            'message'       => 'Mahasiswa Berhasil di Hapus',
        ]);
    }
}
