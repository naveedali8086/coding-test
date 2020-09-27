<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function save(CompanyRequest $request)
    {
        $message = '';
        $data = [];
        $has_err = false;

        if (Company::query()->create($request->all())) {
            $message = 'Saved Successfully';

        } else {
            $has_err = true;
            $message = 'Something went wrong, please try again';
        }

        return \response()->json(['has_err' => $has_err, 'message' => $message, 'data' => $data]);
    }

    public function getCompanies()
    {
        $message = '';
        $data = [];
        $has_err = false;

        try {

            $data = Company::all()->toArray();

        } catch (\Exception $e) {
            $has_err = true;
            $message = 'Something went wrong, please try again';
        }

        return \response()->json(['has_err' => $has_err, 'message' => $message, 'data' => $data]);

    }

}
