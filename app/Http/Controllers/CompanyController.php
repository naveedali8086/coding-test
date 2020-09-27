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

        if (Company::query()->updateOrCreate(['id' => $request->get('id')], $request->except(['_token']))) {
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

    public function delete(Request $request)
    {
        $message = '';
        $has_err = false;

        $company = Company::query()->find($request->get('id'));

        try {

            if ($company && $company->delete()) {
                $message = 'Deleted Successfully';

            } else {
                $has_err = true;
                $message = 'Something went wrong, please try again';
            }

        } catch (\Exception $e) {
            $has_err = true;
            $message = 'This company can not be delete because some employees belong to this company';

        }

        return \response()->json(['has_err' => $has_err, 'message' => $message]);
    }

    public function getCompany($company_id)
    {
        $company = Company::query()->find($company_id);

        $message = '';
        $data = [];
        $has_err = false;

        if ($company) {

            $data['model'] = $company->attributesToArray();

        } else {
            $has_err = true;
            $message = 'The requested item does not exist in system anymore';
        }

        return \response()->json(['has_err' => $has_err, 'message' => $message, 'data' => $data]);
    }

}
