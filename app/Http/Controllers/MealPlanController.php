<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;
use Inertia\Inertia;    
use Illuminate\Support\Facades\Auth;

class MealPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MealPlans/Index');    
    }

    public function dinner()
    {
        $auth_user = Auth::user();

        $assigned_dinner_to_auth_user = MealPlan::where('category', 'dinner')
            ->where('assigned_to', $auth_user->id)
            ->get();

        $dinner = MealPlan::where('category', 'dinner')->get();

        return Inertia::render('MealPlans/Categories/Dinner', [
            'dinner' => $dinner,
            'self_assigned_dinner' => $assigned_dinner_to_auth_user,
        ]);
    }

    public function breakfast()
    {
        $auth_user = Auth::user();

        $breakfast = MealPlan::where('category', 'breakfast')->get();

        $assigned_breakfast_to_auth_user = MealPlan::where('category', 'breakfast')
            ->where('assigned_to', $auth_user->id)
            ->get();

        return Inertia::render('MealPlans/Categories/Breakfast', [
            'breakfast' => $breakfast,
            'self_assigned_breakfast' => $assigned_breakfast_to_auth_user,
        ]);
    }

    public function lunch()
    {
        $auth_user = Auth::user();

        $lunch = MealPlan::where('category', 'lunch')->get();

        $assigned_lunch_to_auth_user = MealPlan::where('category', 'lunch')
            ->where('assigned_to', $auth_user->id)
            ->get();

        return Inertia::render('MealPlans/Categories/Lunch', [
            'lunch' => $lunch,
            'self_assigned_lunch' => $assigned_lunch_to_auth_user,
        ]);
    }

    public function snack()
    {
        $auth_user = Auth::user();

        $snack = MealPlan::where('category', 'snack')->get();

        $assigned_snack_to_auth_user = MealPlan::where('category', 'snack')
            ->where('assigned_to', $auth_user->id)
            ->get();

        return Inertia::render('MealPlans/Categories/Snack', [
            'snack' => $snack,
            'self_assigned_snack' => $assigned_snack_to_auth_user,
        ]);
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
    public function show(MealPlan $mealPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MealPlan $mealPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MealPlan $mealPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MealPlan $mealPlan)
    {
        //
    }
}
