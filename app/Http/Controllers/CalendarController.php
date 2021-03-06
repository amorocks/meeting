<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Week;
use DB;

class CalendarController extends Controller
{
    public function show()
    {
    	return view('calendar.show');
    }

    public function json(Request $request)
    {
        $start = new DateTime($request->start);
        $end = new DateTime($request->end);

        $result = DB::select(
            "SELECT * FROM (SELECT *, STR_TO_DATE(CONCAT(`year`, LPAD(iso_week, 2, 0), 1), '%x%v%w') AS date FROM weeks) AS a WHERE (date BETWEEN :start AND :end)",
            ["start" => $request->start, "end" => $request->end]
        );
        $weeks = Week::hydrate($result);

        $events = array();
        foreach ($weeks as $week)
        {
            $events[] = array(
                "id" => $week->id.'w',
                "title" => $week->title ?? '',
                "allDay" => true,
                "start" => $week->start->format('Y-m-d'),
                "end" => $week->end->modify('+1 day')->format('Y-m-d'),
                "rendering" => "background",
                "className" => $week->term ? "weeknumber primary" : "weeknumber secondary"
            );

            foreach ($week->meetings as $meeting)
            {
                $events[] = array(
                    "id" => $meeting->id.'m',
                    "title" => $meeting->title,
                    "allDay" => true,
                    "start" => $meeting->date->format('Y-m-d'),
                    "end" => $meeting->date->format('Y-m-d'),
                    "url" => route('schoolyears.weeks.meetings.show', [$week->schoolyear, $week, $meeting])
                );
            };

            foreach ($week->events as $event)
            {
                $events[] = array(
                    "id" => $event->id.'m',
                    "title" => $event->title,
                    "allDay" => true,
                    "start" => $event->date->format('Y-m-d'),
                    "end" => $event->date->format('Y-m-d'),
                    "url" => route('schoolyears.weeks.events.edit', [$week->schoolyear, $week, $event]),
                    "className" => "bg-secondary"
                );
            };
        }

        return $events;
    }
}
