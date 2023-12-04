<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcement = Announcement::all()->first();
        return view('Announcements.announcements', compact('announcement'));
    }

    public function saveAnnouncement(Request $request)
    {
        $request->validate([
            'announcementMessage' => 'required|max:200',
            'beginDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:beginDate',
        ]);

        $announcementData = [
            'message' => $request->input('announcementMessage'),
            'begin_date' => $request->input('beginDate'),
            'end_date' => $request->input('endDate'),
        ];

        $announcement = Announcement::first();

        if ($announcement) {
            $announcement->update($announcementData);
        } else {
            Announcement::create($announcementData);
        }

        return redirect()->back()->with('status', 'Announcement saved successfully');
    }
}
