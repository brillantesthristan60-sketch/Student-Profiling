<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSkill;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * Display the query/filtering interface
     */
    public function index()
    {
        return view('queries.index');
    }

    /**
     * Search students by skill
     */
    public function searchBySkill(Request $request)
    {
        $skill = $request->get('skill');
        $format = $request->get('format', 'table'); // table, list, cards

        $query = Student::with(['user', 'skills', 'activities', 'affiliations']);

        if ($skill) {
            $query->whereHas('skills', function ($q) use ($skill) {
                $q->where('skill_name', 'LIKE', '%' . $skill . '%');
            });
        }

        $students = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'students' => $students,
                'format' => $format
            ]);
        }

        return view('queries.results', compact('students', 'skill', 'format'));
    }

    /**
     * Search students by activity
     */
    public function searchByActivity(Request $request)
    {
        $activity = $request->get('activity');
        $format = $request->get('format', 'table');

        $query = Student::with(['user', 'skills', 'activities', 'affiliations']);

        if ($activity) {
            $query->whereHas('activities', function ($q) use ($activity) {
                $q->where('activity_name', 'LIKE', '%' . $activity . '%');
            });
        }

        $students = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'students' => $students,
                'format' => $format
            ]);
        }

        return view('queries.results', compact('students', 'activity', 'format'));
    }

    /**
     * Advanced multi-condition filtering
     */
    public function advancedSearch(Request $request)
    {
        $query = Student::with(['user', 'skills', 'activities', 'affiliations']);

        // Skill filter
        if ($request->filled('skill')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('skill_name', 'LIKE', '%' . $request->skill . '%');
            });
        }

        // Activity filter
        if ($request->filled('activity')) {
            $query->whereHas('activities', function ($q) use ($request) {
                $q->where('activity_name', 'LIKE', '%' . $request->activity . '%');
            });
        }

        // Year level filter
        if ($request->filled('year_level')) {
            $query->where('year_level', $request->year_level);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->paginate(10);
        $format = $request->get('format', 'table');

        return view('queries.results', compact('students', 'format'));
    }

    /**
     * Get all available skills for autocomplete
     */
    public function getSkills()
    {
        $skills = StudentSkill::select('skill_name')
            ->distinct()
            ->pluck('skill_name')
            ->toArray();

        return response()->json($skills);
    }

    /**
     * Get all available activities for autocomplete
     */
    public function getActivities()
    {
        $activities = \App\Models\StudentActivity::select('activity_name')
            ->distinct()
            ->pluck('activity_name')
            ->toArray();

        return response()->json($activities);
    }
}
