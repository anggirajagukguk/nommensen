<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cooperation;
use App\Models\Greeting;
use App\Models\Facility;
use App\Models\Visimisi;
use App\Models\Rektor;
use App\Models\Aboutme;
use App\Models\Footer;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Lecture;
use App\Models\Admin;
use App\Models\Student;
use App\Models\History;

class LandingpageController extends Controller
{
    public function index()
    {
        $cooperations = Cooperation::all();
        $greeting     = Greeting::first();
        $facilities   = Facility::all();
        $visimisi     = Visimisi::first();
        $rektors      = Rektor::orderBy('id', 'asc')->get();
        $aboutme      = Aboutme::first();
        $footer       = Footer::first();

        $latestNews          = News::with('user')->latest()->paginate(3);
        $latestAnnouncements = Announcement::with('user')->latest()->paginate(3);

        return view('landingpage', compact(
            'cooperations',
            'greeting',
            'facilities',
            'visimisi',
            'rektors',
            'aboutme',
            'footer',
            'latestNews',
            'latestAnnouncements'
        ));
    }

    public function lectures()
    {
        $lectures = Lecture::orderBy('nama', 'asc')->paginate(9);
        $footer   = Footer::first();

        return view('lectures', compact('lectures', 'footer'));
    }

    public function profile()
    {
        $aboutme  = Aboutme::first();
        $history  = History::first();
        $visimisi = Visimisi::first();
        $rektors  = Rektor::orderBy('id', 'asc')->get();
        $admins   = Admin::orderBy('nama', 'asc')->get();
        $footer   = Footer::first();

        return view('profile', compact(
            'aboutme',
            'history',
            'visimisi',
            'rektors',
            'admins',
            'footer'
        ));
    }

    public function announcements()
    {
        $announcements = Announcement::with('user')->latest()->paginate(6);
        $footer        = Footer::first();

        return view('announcements', compact('announcements', 'footer'));
    }

    public function news()
    {
        $news   = News::with('user')->latest()->paginate(6);
        $footer = Footer::first();

        return view('news', compact('news', 'footer'));
    }

    public function students()
    {
        $students = Student::orderBy('namalengkap', 'asc')->paginate(12);
        $footer   = Footer::first();

        return view('students', compact('students', 'footer'));
    }
}
