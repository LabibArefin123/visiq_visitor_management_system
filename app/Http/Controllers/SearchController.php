<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\SubArea;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use App\Models\RoomList;
use App\Models\User;
use App\Models\UserCategory;
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
use App\Models\InterviewSchedule;
use App\Models\WeekendSchedule;

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

        $areas = Area::where('name', 'LIKE', "%$q%")
            ->get(['id', 'name'])
            ->map(function ($area) {
                $area->type = 'areas';
                return $area;
            });

        $sub_areas = SubArea::where('sub_area_name', 'LIKE', "%$q%")
            ->get(['id', 'sub_area_name as name'])
            ->map(function ($sarea) {
                $sarea->type = 'sub_areas';
                return $sarea;
            });

        $building_locations = BuildingLocation::where('name', 'LIKE', "%$q%")
            ->get(['id', 'name'])
            ->map(function ($blocation) {
                $blocation->type = 'building_locations';
                return $blocation;
            });

        $building_lists = BuildingList::where('name', 'LIKE', "%$q%")
            ->orWhere('name_in_bangla', 'LIKE', "%$q%")
            ->orWhere('level', 'LIKE', "%$q%")
            ->orWhere('unit_per_level', 'LIKE', "%$q%")
            ->get(['id', 'name', 'name_in_bangla', 'level', 'unit_per_level'])
            ->map(function ($blist) {
                $blist->type = 'building_lists';
                return $blist;
            });

        $room_lists = RoomList::where('room_name', 'LIKE', "%$q%")
            ->orWhere('room_name_in_bangla', 'LIKE', "%$q%")
            ->orWhere('level', 'LIKE', "%$q%")
            ->get(['id', 'room_name as name', 'room_name_in_bangla', 'level'])
            ->map(function ($rlist) {
                $rlist->type = 'room_lists';
                return $rlist;
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

        // Search branches
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

        $visitor_host_schedules = VisitorHostSchedule::leftJoin(
            'visitors',
            'visitor_host_schedules.visitor_id',
            '=',
            'visitors.id'
        )
            ->where('visitor_host_schedules.status', 'LIKE', "%{$q}%")
            ->orWhere('visitor_host_schedules.meeting_date', 'LIKE', "%{$q}%")
            ->orWhere('visitors.name', 'LIKE', "%{$q}%")
            ->limit(10)
            ->get([
                'visitor_host_schedules.id',
                'visitor_host_schedules.status',
                'visitor_host_schedules.meeting_date',
                'visitors.name as name'
            ])
            ->map(function ($items) {
                $items->type = 'visitor_host_schedules';
                return $items;
            });

        $visitor_group_schedules = VisitorGroupSchedule::select(
            'visitor_group_schedules.id',
            'visitor_group_schedules.status',
            'visitor_group_schedules.meeting_date',
            'visitor_group_members.group_name as name'
        )
            ->leftJoin('visitor_group_members', 'visitor_group_schedules.visitor_group_id', '=', 'visitor_group_members.id')
            ->leftJoin('employees', 'visitor_group_schedules.employee_id', '=', 'employees.id')
            ->where(function ($query) use ($q) {
                $query->where('visitor_group_schedules.status', 'LIKE', "%{$q}%")
                    ->orWhere('visitor_group_schedules.purpose', 'LIKE', "%{$q}%")
                    ->orWhere('visitor_group_schedules.meeting_date', 'LIKE', "%{$q}%")
                    ->orWhere('visitor_group_members.group_name', 'LIKE', "%{$q}%")
                    ->orWhere('employees.name', 'LIKE', "%{$q}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $item->type = 'visitor_group_schedules';
                return $item;
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

        $interview_schedules = InterviewSchedule::select(
            'interview_schedules.id',
            'interview_schedules.status',
            'interview_schedules.interview_date',
            'visitor_job_applications.name as name' // candidate name
        )
            ->leftJoin('visitor_job_applications', 'interview_schedules.candidate_id', '=', 'visitor_job_applications.id')
            ->where(function ($query) use ($q) {
                $query->where('interview_schedules.status', 'LIKE', "%{$q}%")
                    ->orWhere('interview_schedules.interview_date', 'LIKE', "%{$q}%")
                    ->orWhere('visitor_job_applications.name', 'LIKE', "%{$q}%"); // search by candidate name
            })
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $item->type = 'interview_schedules';
                return $item;
            });

        $weekend_schedules = WeekendSchedule::where('slot_name', 'LIKE', "%$q%")
            ->orWhere('status', 'LIKE', "%$q%")
            ->get(['id', 'slot_name as name', 'status'])
            ->map(function ($ws) {
                $ws->type = 'weekend_schedules';
                return $ws;
            });

        $user_categories = UserCategory::where('category_name', 'LIKE', "%$q%")
            ->orWhere('category_name_in_bangla', 'LIKE', "%$q%")
            ->get(['id', 'category_name as name', 'category_name_in_bangla'])
            ->map(function ($ucat) {
                $ucat->type = 'user_categories';
                return $ucat;
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
            ->merge($areas)
            ->merge($sub_areas)
            ->merge($building_locations)
            ->merge($building_lists)
            ->merge($room_lists)
            ->merge($employees)
            ->merge($branches)
            ->merge($divisions)
            ->merge($departments)
            ->merge($employees)
            ->merge($interview_schedules)
            ->merge($weekend_schedules)
            ->merge($user_categories)
            ->merge($system_users)
            ->merge($pending_visitors)
            ->merge($emergency_visitors)
            ->merge($visitor_job_applications)
            ->merge($visitor_host_schedules)
            ->merge($visitor_group_schedules)
            ->merge($visitor_probations)
            ->merge($blacklist_visitors));
    }
}
