<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exercise;
// use Illuminate\Support\Facades\Log;
use App\Models\ExerciseCounter;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth_user = Auth::user();
        
        // Get the search query
        $search = $request->input('search');
    
        // Get all exercises or filter by search query
        $exercises = Exercise::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%")
                             ->orWhere('content', 'like', "%{$search}%");
            })
            ->select('id', 'name', 'description', 'content', 'created_at')
            ->get();
    
        // Get exercise counters for the logged-in user
        $exercise_counters = ExerciseCounter::where('user_id', $auth_user->id)
            ->pluck('exercise_id')
            ->toArray();
    
        $noResults = $search && $exercises->isEmpty();
    
        return Inertia::render('Exercises/Index', [
            'user_id' => $auth_user->id,
            'user_role' => $auth_user->role,
            'exercises' => $exercises,
            'exercise_counters' => $exercise_counters,
            'search' => $search,
            'noResults' => $noResults,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Exercises/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);

        // store
        Exercise::create($validatedData);

        return redirect()->route('exercises.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $exercise = Exercise::findOrFail($id);
        
        // Get all the exercise counters with the related user data
        $exercise_counter = ExerciseCounter::where('exercise_id', $id)
            ->with('user:id,name') // Eager load the user with only the id and name fields
            ->get();
        
        // Get the count of the exercise counters
        $exercise_counter_count = $exercise_counter->count();
    
        return Inertia::render('Exercises/Show', [
            'exercise' => $exercise,
            'exercise_counter' => $exercise_counter,
            'exercise_counter_count' => $exercise_counter_count,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $to_delete = Exercise::findOrFail($id);
        $to_delete->delete();
    }
}