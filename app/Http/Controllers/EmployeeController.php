<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
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

    public function delete(Request $request)
    {
        $message = '';
        $has_err = false;

        $employee = Employee::query()->find($request->get('id'));

        try {

            if ($employee && $employee->delete()) {
                $message = 'Deleted Successfully';

            } else {
                $has_err = true;
                $message = 'Something went wrong, please try again';
            }

        } catch (\Exception $e) {
            $has_err = true;
            $message = 'Something went wrong, please try again';

        }

        return \response()->json(['has_err' => $has_err, 'message' => $message]);
    }
}
