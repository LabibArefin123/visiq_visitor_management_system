<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemNotification;
use App\Models\VisitorAlert;
use App\Models\VisitorCheckout;
use App\Models\CheckOutEmployee;
use App\Models\Visitor;
use App\Models\VisitorAlertMessage;

class Notification_And_Alert extends Controller
{
    public function visitor_alert()
    {
        return view('notification_and_alert.visitor_alert_index');
    }

    public function overdue_checkout_alert()
    {
        // Fetch overdue employees
        $overdueEmployees = CheckOutEmployee::where('expected_checkout_time', '<', now())
            ->whereNull('check_out_time') // Ensure they're not already checked out
            ->get();

        return view('notification_and_alert.overdue_checkout_alert_index', compact('overdueEmployees'));
    }

    public function notifyOverdue($id)
    {
        $employee = CheckOutEmployee::findOrFail($id);

        // Logic to send notification (e.g., email, SMS, push notification)
        // Example: Send an email (uncomment the line below if you're using Laravel Mail)
        // \Mail::to($employee->email)->send(new OverdueAlertMail($employee));

        return back()->with('success', "Notification sent to {$employee->name}.");
    }


    public function system_notification()
    {
        $notifications = SystemNotification::latest()->paginate(10); // Fetch with pagination
        $totalSystemNotifications = SystemNotification::count(); // Get total count

        return view('notification_and_alert.system_notification_index', compact('notifications', 'totalSystemNotifications'));
    }


    public function createSystemNotification()
    {
        return view('notification_and_alert.system_notification_create');
    }

    public function storeSystemNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'target_audience' => 'required|string',
        ]);

        SystemNotification::create($request->all());

        return redirect()->route('system_notification')->with('success', 'Notification added successfully.');
    }

    public function deleteSystemNotification($id)
    {
        $notification = SystemNotification::findOrFail($id);
        $notification->delete();

        return redirect()->route('system_notification')->with('success', 'Notification deleted successfully.');
    }

    public function visitor_alert_index()
    {
        $alerts = VisitorAlert::paginate(10);
        return view('notification_and_alert.visitor_alert_index', compact('alerts'));
    }

    public function visitor_alert_create()
    {
        return view('notification_and_alert.visitor_alert_create');
    }

    public function visitor_alert_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger',
        ]);

        VisitorAlert::create($request->all());

        return redirect()->route('visitor_alerts.index')->with('success', 'Alert created successfully!');
    }

    public function visitor_alert_destroy($id)
    {
        $alert = VisitorAlert::findOrFail($id);
        $alert->delete();

        return redirect()->route('visitor_alerts.index')->with('success', 'Alert deleted successfully!');
    }

    public function showNotifyForm()
    {
        $visitors = Visitor::all();
        return view('notification_and_alert.notify_form', compact('visitors'));
    }


    public function sendVisitorAlert(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'title'      => 'required|string|max:255',
            'message'    => 'required|string',
        ]);

        VisitorAlertMessage::create([
            'visitor_id' => $request->visitor_id,
            'title'      => $request->title,
            'message'    => $request->message,
        ]);

        return redirect()->route('visitor_alerts.index')->with('success', 'Notification sent successfully!');
    }
}
