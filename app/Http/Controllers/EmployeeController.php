<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
    $query = Employee::query();

    if ($request->has('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    if ($request->has('division_id')) {
        $query->where('division_id', $request->input('division_id'));
    }

    $employees = $query->with('division')->paginate(10);

    return response()->json([
        'status' => 'success',
        'message' => 'Data retrieved successfully',
        'data' => [
            'employees' => $employees->items(),
            ],
        'pagination' => [
            'current_page' => $employees->currentPage(),
            'last_page' => $employees->lastPage(),
            'per_page' => $employees->perPage(),
            'total' => $employees->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'division' => 'required|exists:divisions,id',
            'position' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $employee = new Employee([
            'id' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'division_id' => $request->division,
            'position' => $request->position,
            'image' => $imagePath,
        ]);

        if ($employee->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Karyawan berhasil ditambahkan.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan karyawan.',
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'position' => 'required|string|max:255',
            'division_id' => 'required|uuid|exists:divisions,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            $data['image'] = $request->file('image')->store('employees', 'public');
        }

        $employee->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data employee berhasil diperbarui',
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }

        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data employee berhasil dihapus',
        ]);
    }
}
