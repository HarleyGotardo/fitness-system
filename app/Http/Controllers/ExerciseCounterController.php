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
}
