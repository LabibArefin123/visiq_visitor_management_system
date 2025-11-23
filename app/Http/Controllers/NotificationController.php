<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class NotificationController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->q;

        $visitors = Visitor::where('name', 'LIKE', "%$q%")
            ->orWhere('visitor_id', 'LIKE', "%$q%")
            ->orWhere('phone', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->limit(10)
            ->get(['id', 'name', 'visitor_id', 'phone', 'email']);

        return response()->json($visitors);
    }
}
