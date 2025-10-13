<?php

namespace App\Http\Controllers;

use App\Models\VisitorCheckInAI;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VisitorCheckin;
use App\Models\VisitorCheckout;

class Visitor_Attendance extends Controller
{
    public function check_in_visitor()
    {
        $checkInVisitors = VisitorCheckin::with('visitor')->get();
        $totalVisitorCheckin = $checkInVisitors->sum('total_checkins');

        return view('visitor_management.check_in_visitor_index', compact('checkInVisitors', 'totalVisitorCheckin'));
    }


    public function check_out_visitor()
    {
        $checkOutVisitors = VisitorCheckout::with('visitor')->get();
        $totalCheckouts = $checkOutVisitors->sum('total_checkouts'); // Sum total_checkouts column

        return view('visitor_management.check_out_visitor_index', compact('checkOutVisitors', 'totalCheckouts'));
    }


    public function checkout_visitor_manual()
    {
        $visitors = Visitor::all(); // Fetch all visitors
        return view('visitor_management.check_out_visitor_manual', compact('visitors'));
    }

    public function checkin_visitor_manual()
    {
        $visitors = Visitor::all(); // Fetch all visitors
        return view('visitor_management.check_in_visitor_manual', compact('visitors'));
    }

    public function store_checkout_manual(Request $request)
    {
        $validated = $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'check_out_time' => 'required|date_format:H:i',
        ]);

        try {
            // Find the visitor by ID
            $visitor = Visitor::findOrFail($validated['visitor_id']);

            // Calculate age from the visitor's DOB
            $dob = $visitor->date_of_birth;
            $age = $dob ? \Carbon\Carbon::parse($dob)->age : null;

            // Parse check-out time
            $checkOutTime = \Carbon\Carbon::createFromFormat('H:i', $validated['check_out_time']);

            // Check if the visitor already has a check-out entry for today
            $existingCheckout = VisitorCheckout::where('visitor_id', $visitor->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($existingCheckout) {
                // Update existing record instead of creating a new one
                $existingCheckout->update([
                    'check_out_time' => $checkOutTime,
                    'age' => $age,
                    'total_checkouts' => $existingCheckout->total_checkouts + 1, // Increment check-outs
                ]);
            } else {
                // Create a new check-out entry if none exists
                VisitorCheckout::create([
                    'visitor_id' => $visitor->id,
                    'check_out_time' => $checkOutTime,
                    'age' => $age,
                    'purpose' => $visitor->purpose,
                    'total_checkouts' => 1,
                ]);
            }

            return redirect()->route('visitor_check_out')->with('success', 'Visitor checked out successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing the check-out.']);
        }
    }


    public function store_checkin_manual(Request $request)
    {
        $validated = $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'check_in_time' => 'required|date_format:H:i',
        ]);

        try {
            // Find the visitor by ID
            $visitor = Visitor::findOrFail($validated['visitor_id']);

            // Calculate age from the visitor's DOB
            $dob = $visitor->date_of_birth;
            $age = $dob ? \Carbon\Carbon::parse($dob)->age : null;

            // Parse check-in time and determine status
            $checkInTime = \Carbon\Carbon::createFromFormat('H:i', $validated['check_in_time']);
            $status = $checkInTime->lte(\Carbon\Carbon::createFromTime(8, 0)) ? 'On Time' : 'Late';

            // Check if a record already exists for this visitor at the same time
            $existingCheckIn = VisitorCheckin::where('visitor_id', $visitor->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($existingCheckIn) {
                // Update existing record instead of creating a new one
                $existingCheckIn->update([
                    'check_in_time' => $checkInTime,
                    'status' => $status,
                    'age' => $age,
                    'total_checkins' => $existingCheckIn->total_checkins + 1, // Increment check-ins
                ]);
            } else {
                // Create a new check-in entry if none exists
                VisitorCheckin::create([
                    'visitor_id' => $visitor->id,
                    'check_in_time' => $checkInTime,
                    'status' => $status,
                    'age' => $age,
                    'total_checkins' => 1,
                ]);
            }

            return redirect()->route('check_in_visitor')->with('success', 'Visitor checked in successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing the check-in.']);
        }
    }

  
}
