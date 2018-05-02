<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suggestion;
use App\Schoolyear;
use App\Week;
use App\Meeting;
use App\Listing;

class MeetingController extends Controller
{
    public function create(Schoolyear $schoolyear, Week $week)
    {
    	return view('meetings.create')->with('schoolyear', $schoolyear)->with('week', $week);
    }

    public function store(Schoolyear $schoolyear, Week $week, Request $request)
    {
    	$request->validate([
    		'date' => 'required|date_format:"Y-m-d"',
    		'title' => 'nullable'
    	]);

    	$meeting = new Meeting();
    	$meeting->week_id = $week->id;
    	$meeting->date = $request->date;
    	$meeting->title = $request->title ?? "Teamvergadering";
    	$meeting->save();

    	return redirect()->route('schoolyears.show', $schoolyear);
    }

    public function show(Schoolyear $schoolyear, Week $week, Meeting $meeting)
    {
        return view('meetings.show')
            ->with('suggestions', Suggestion::findForMeeting($meeting))
            ->with('meetings', Meeting::where('date', '>', date('Y-m-d'))->orderBy('date')->get())
            ->with(compact('schoolyear'))
            ->with(compact('week'))
            ->with(compact('meeting'));
    }

    public function agenda_edit(Meeting $meeting)
    {
        return view('meetings.agenda_edit')
            ->with('schoolyear', $meeting->week->schoolyear)
            ->with('week', $meeting->week)
            ->with('meeting', $meeting);
    }

    public function agenda_save(Meeting $meeting, Request $request)
    {
        foreach($request->items as $id => $item)
        {
            $listing = Listing::find($id);
            $listing->order = $item['order'];
            $listing->duration = $item['duration'];
            $listing->save();
        }

        return redirect()->route('schoolyears.weeks.meetings.show', [$meeting->week->schoolyear, $meeting->week, $meeting]);
    }
}
