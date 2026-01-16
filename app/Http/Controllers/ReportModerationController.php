<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportModerationController extends Controller
{
    public function index()
    {
        // Load reports with reporter (User) info
        $reports = Report::with(['reporter'])->get();
        return view('reportmoderation', compact('reports'));
    }

    // This method handles the AJAX buttons in your modal
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        
        // Update status based on button clicked
        $report->status = $request->status; 
        $report->save();

        // Return JSON so the JavaScript "fetch" knows it worked
        return response()->json([
            'success' => true,
            'message' => 'Status updated to ' . $request->status
        ]);
    }

    public function deletePost($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return back()->with('success', 'Record removed successfully.');
    }
}