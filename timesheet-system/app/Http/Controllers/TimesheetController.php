<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;


class TimesheetController extends Controller
{
    public function index(){
        $timesheets = Timesheet::where('user_id',auth()->id())->get();
        return view('timesheets.index', compact('timesheets'));
    }

    public function create(){
        return view('timesheets.create');
    }

    public function store(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'hours_worked' => 'required|float',
            'description' => 'required|string',
        ]);

        Timesheet::create([
            'user_id' => auth()-> id(),
            'date'=> $request->date,
            'hours_worked'=> $request-> hours_worked,
            'description' => $request->description,
            'status' => 'Pending',
        ]);

        return redirect()-> route('timesheets.index');
    }

    public function show(Timesheet $timesheet) {
        $this-> authorize('view',$timesheet);
        return view('timesheets.show', compact('timesheet'));
    }
}
