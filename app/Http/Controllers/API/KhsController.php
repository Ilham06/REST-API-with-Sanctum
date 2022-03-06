<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KhsController extends Controller
{
    public function create(Request $request)
    {
        $data = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'periode' => 'required',
            'semester' => 'required',
            'score' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json($data->errors());
        }

        $student = Student::find($request->student_id);

        $recentScore = $student->course()->where('course_id', $request->course_id)->exists();

        if ($recentScore) {
            return response()->json([
                'message'       => 'Nilai Sudah Ada'
            ]);
        }

        $student->course()->attach($request->course_id, [
            'periode' => $request->periode,
            'semester' => $request->semester,
            'score' => $request->score
        ]);

        return response()->json([
            'message'       => 'Nilai Berhasil di Tambahkan.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $data = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'periode' => 'required',
            'semester' => 'required',
            'score' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json($data->errors());
        }

        $student->course()->updateExistingPivot($request->course_id, [
            'score' => $request->score,
            'semester' => $request->semester,
            'periode' => $request->periode,
        ]);

        return response()->json([
            'message'       => 'Nilai Berhasil di Ubah.'
        ]);
    }

    public function delete(Request $request, $id)
    {
        $student = Student::find($id);
        $student->course()->detach($request->course_id);

        return response()->json([
            'message'       => 'Nilai Berhasil di Hapus.'
        ]);
    }
}
