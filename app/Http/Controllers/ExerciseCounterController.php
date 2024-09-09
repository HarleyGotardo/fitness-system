<?php

namespace App\Http\Controllers;

use App\Models\ExerciseCounter;
use Illuminate\Http\Request;

class ExerciseCounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function add_to_counter($exercise_id, $user_id)
    {
        $exercise_counter = new ExerciseCounter();
        $exercise_counter->exercise_id = $exercise_id;
        $exercise_counter->user_id = $user_id;
        $exercise_counter->save();
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExerciseCounter $exerciseCounter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExerciseCounter $exerciseCounter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExerciseCounter $exerciseCounter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExerciseCounter $exerciseCounter)
    {
        //
    }
}
