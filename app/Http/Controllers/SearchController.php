<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
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

        // Search Visitor Host Schedule
        $visitor_host_schedules = VisitorHostSchedule::with(['visitor', 'employee'])
            ->where(function ($query) use ($q) {
                // Visitor fields
                $query->whereHas('visitor', function ($sub) use ($q) {
                    $sub->where('name', 'LIKE', "%$q%")
                        ->orWhere('visitor_id', 'LIKE', "%$q%")
                        ->orWhere('phone', 'LIKE', "%$q%");
                });

                // Employee fields (separate orWhere)
                $query->orWhereHas('employee', function ($sub) use ($q) {
                    $sub->where('name', 'LIKE', "%$q%")
                        ->orWhere('emp_id', 'LIKE', "%$q%");
                });

                // Host schedule fields (separate orWhere)
                $query->orWhere(function ($sub) use ($q) {
                    $sub->where('purpose', 'LIKE', "%$q%")
                        ->orWhere('status', 'LIKE', "%$q%")
                        ->orWhere('meeting_date', 'LIKE', "%$q%");
                });
            })
            ->get()
            ->map(function ($vhs) {
                return [
                    'id'    => $vhs->id,
                    'name'  => $vhs->visitor->name ?? 'Unknown Visitor',
                    'code'  => 'H' . $vhs->id,
                    'phone' => $vhs->visitor->phone ?? null,
                    'email' => $vhs->visitor->email ?? null,
                    'type'  => 'visitor_host_schedules',
                ];
            });

        // Search Visitor Group Schedule
        $visitor_group_schedules = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
            ->where(function ($query) use ($q) {
                // Visitor group fields
                $query->whereHas('visitorGroup', function ($sub) use ($q) {
                    $sub->where('group_name', 'LIKE', "%$q%");
                });

                // Employee fields
                $query->orWhereHas('employee', function ($sub) use ($q) {
                    $sub->where('name', 'LIKE', "%$q%")
                        ->orWhere('emp_id', 'LIKE', "%$q%");
                });

                // Group schedule fields
                $query->orWhere(function ($sub) use ($q) {
                    $sub->where('purpose', 'LIKE', "%$q%")
                        ->orWhere('status', 'LIKE', "%$q%")
                        ->orWhere('meeting_date', 'LIKE', "%$q%");
                });
            })
            ->get()
            ->map(function ($vgs) {
                return [
                    'id'    => $vgs->id,
                    'name'  => $vgs->visitorGroup->group_name ?? 'Unknown Group', // matches v.name in your JS
                    'code'  => 'G' . $vgs->id,
                    'phone' => null,
                    'email' => null,
                    'type'  => 'visitor_group_schedules',
                ];
            });

        return response()->json($visitors
            ->merge($company_visitors)
            ->merge($employees)
            ->merge($pending_visitors)
            ->merge($emergency_visitors)
            ->merge($visitor_job_applications)
            ->merge($visitor_host_schedules)
            ->merge($visitor_group_schedules)
            ->merge($visitor_probations)
            ->merge($blacklist_visitors));
    }
}
