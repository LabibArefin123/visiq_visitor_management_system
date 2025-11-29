<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorFeedbacks;

class VisitorFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = VisitorFeedbacks::with(['visitor', 'pendingVisitor'])->orderBy('submitted_at', 'asc')->get();
        return view('communication_management.visitor_feedback.index', compact('feedbacks'));
    }
}
