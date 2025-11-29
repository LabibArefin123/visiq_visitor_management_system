<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Organization;
use App\Models\Branch;
use App\Models\Division;
use App\Models\Department;
use App\Models\Visitor;
use App\Models\VisitorCompany;
use App\Models\PendingVisitor;
use App\Models\BlacklistedVisitor;
use App\Models\VisitorEmergency;
use App\Models\VisitorProbation;
use App\Models\VisitorJobApplication;
use App\Models\VisitorHostSchedule;
use App\Models\VisitorGroupSchedule;

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

        $organizations = Organization::where('name', 'LIKE', "%$q%")
            ->get(['id', 'name'])
            ->map(function ($org) {
                $org->type = 'organizations';
                return $org;
            });

        // Search Company Visitors
        $company_visitors = VisitorCompany::where('company_name', 'LIKE', "%$q%")
            ->orWhere('contact_person', 'LIKE', "%$q%")
            ->orWhere('address', 'LIKE', "%$q%")
            ->orWhere('city', 'LIKE', "%$q%")
            ->orWhere('country', 'LIKE', "%$q%")
            ->orWhere('company_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'company_name as name', 'company_id as code', 'phone', 'email', 'contact_person', 'address', 'city', 'country'])
            ->map(function ($v) {
                $v->type = 'visitor_companies';
                return $v;
            });



        //Search Pending Visitor
        $pending_visitors = PendingVisitor::where('name', 'LIKE', "%$q%")
            ->orWhere('visitor_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->get(['id', 'name', 'visitor_id as code', 'phone', 'email'])
            ->map(
                function ($pv) {
                    $pv->type = 'pending_visitors';
                    return $pv;
                }
            );

        //Search Emergency Visitor
        $emergency_visitors = VisitorEmergency::where('name', 'LIKE', "%$q%")
            ->orWhere('emergency_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->get(['id', 'name', 'emergency_id as code', 'phone', 'email'])
            ->map(
                function ($ev) {
                    $ev->type = 'visitor_emergencys';
                    return $ev;
                }
            );

        //Search Blacklists Visitor
        $blacklist_visitors = BlacklistedVisitor::where('name', 'LIKE', "%$q%")
            ->orWhere('blacklist_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->get(['id', 'name', 'blacklist_id as code', 'phone'])
            ->map(
                function ($blv) {
                    $blv->type = 'visitor_blacklists';
                    return $blv;
                }
            );

        //Search Probation Visitor
        $visitor_probations = VisitorProbation::where('name', 'LIKE', "%$q%")
            ->orWhere('probation_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('status', 'LIKE', "%$q%")
            ->orWhere('national_id', 'LIKE', "%$q%")
            ->get(['id', 'name', 'probation_id as code', 'phone', 'status', 'national_id'])
            ->map(
                function ($pbv) {
                    $pbv->type = 'visitor_probations';
                    return $pbv;
                }
            );

        // Search Visitor Job Application
        $visitor_job_applications = VisitorJobApplication::where(function ($query) use ($q) {
            $query->where('name', 'LIKE', "%$q%")
                ->orWhere('application_id', 'LIKE', "%$q%")
                ->orWhere('phone', 'LIKE', "%$q%")
                ->orWhere('status', 'LIKE', "%$q%")
                ->orWhere('position', 'LIKE', "%$q%");
        })
            ->get()
            ->map(function ($vj) {
                return [
                    'id'    => $vj->id,
                    'name'  => $vj->name,              // stays as name
                    'code'  => $vj->application_id,    // show actual application code
                    'phone' => $vj->phone,
                    'email' => null,
                    'type'  => 'visitor_job_applications',
                ];
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

        // Search Employees (YOUR FIXED FIELDS)
        $branches = Branch::where('name', 'LIKE', "%$q%")
            ->orWhere('branch_code', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->orWhere('address', 'LIKE', "%$q%")
            ->orWhere('contact_person', 'LIKE', "%$q%")
            ->orWhere('contact_phone', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'branch_code as code', 'phone', 'email', 'address', 'contact_person', 'contact_phone'])
            ->map(function ($br) {
                $br->type = 'branches';
                return $br;
            });

        $divisions = Division::where('name', 'LIKE', "%$q%")
            ->orWhere('div_code', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->orWhere('address', 'LIKE', "%$q%")
            ->orWhere('contact_person', 'LIKE', "%$q%")
            ->orWhere('contact_phone', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'div_code as code', 'phone', 'email', 'address', 'contact_person', 'contact_phone'])
            ->map(function ($div) {
                $div->type = 'divisions';
                return $div;
            });

        $departments = Department::where('name', 'LIKE', "%$q%")
            ->orWhere('dept_code', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->orWhere('address', 'LIKE', "%$q%")
            ->orWhere('contact_person', 'LIKE', "%$q%")
            ->orWhere('contact_phone', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'dept_code as code', 'phone', 'email', 'address', 'contact_person', 'contact_phone'])
            ->map(function ($dep) {
                $dep->type = 'departments';
                return $dep;
            });

        $system_users = User::where('name', 'LIKE', "%$q%")
            ->orWhere('username', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->get(['id', 'name', 'username', 'email'])
            ->map(function ($u) {
                $u->type = 'system_users';
                return $u;
            });

        return response()->json($visitors
            ->merge($company_visitors)
            ->merge($organizations)
            ->merge($employees)
            ->merge($branches)
            ->merge($divisions)
            ->merge($departments)
            ->merge($system_users)
            ->merge($pending_visitors)
            ->merge($emergency_visitors)
            ->merge($visitor_job_applications)
            ->merge($visitor_probations)
            ->merge($blacklist_visitors));
    }
}
