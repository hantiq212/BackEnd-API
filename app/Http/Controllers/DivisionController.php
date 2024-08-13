<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(Request $request){
        $query = Division::query();
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        $divisions = $query->paginate(10);
        return response()->json([
            'status' => 'success',
            'message' => 'Data divisions berhasil diambil',
            'data' => ['divisions' => $divisions],
            'pagination' => [
                'total' => $divisions->total(),
                'per_page' => $divisions->perPage(),
                'current_page' => $divisions->currentPage(),
                'last_page' => $divisions->lastPage(),
                'from' => $divisions->firstItem(),
                'to' => $divisions->lastItem(),
            ],
        ]);
    }
}
