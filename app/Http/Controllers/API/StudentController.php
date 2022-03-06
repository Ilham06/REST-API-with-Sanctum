<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
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
        $student = Student::find($id);

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
