<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function save(EmployeeRequest $request)
    {
        $message = '';
        $data = [];
        $has_err = false;

        if (Employee::query()->create($request->all())) {
            $message = 'Saved Successfully';

        } else {
            $has_err = true;
            $message = 'Something went wrong, please try again';
        }

        return \response()->json(['has_err' => $has_err, 'message' => $message, 'data' => $data]);
    }

    public function getEmployees()
    {
        $message = '';
        $data = [];
        $has_err = false;

        try {

            $data = DB::table('employees as e')->join('companies as c', 'e.company', '=', 'c.id')
                ->select(['e.*', 'c.name as company'])->get()->toArray();

        } catch (\Exception $e) {
            $has_err = true;
            $message = 'Something went wrong, please try again';
        }

        return \response()->json(['has_err' => $has_err, 'message' => $message, 'data' => $data]);

    }
}
