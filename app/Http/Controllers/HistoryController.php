<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::where('user_id', auth()->id())->latest()->get();
        return view('history.index', compact('histories'));
    }

    public function store($activity)
    {
        History::create([
            'user_id' => auth()->id(),
            'activity' => $activity,
        ]);
    }
}
