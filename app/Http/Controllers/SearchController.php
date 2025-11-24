<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Visitor;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->q ?? $request->adminlteSearch;

        if (!$q) {
            return response()->json([]);
        }

        // Search Visitors
        $visitors = Visitor::where('name', 'LIKE', "%$q%")
            ->orWhere('visitor_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'visitor_id as code', 'phone', 'email'])
            ->map(function ($v) {
                $v->type = 'visitors';
                return $v;
            });

        // Search Employees (YOUR FIXED FIELDS)
        $employees = Employee::where('name', 'LIKE', "%$q%")
            ->orWhere('emp_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'emp_id as code', 'phone', 'email'])
            ->map(function ($e) {
                $e->type = 'employees';
                return $e;
            });

        return response()->json($visitors->merge($employees));
    }
}
