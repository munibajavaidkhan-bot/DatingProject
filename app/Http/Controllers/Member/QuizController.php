<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;

class QuizController extends Controller
{
    /**
     * Start the quiz, usually redirects to quiz/1.
     */
    public function index()
    {
        // Redirect to the first question page (quiz.show with ID 1)
        return redirect()->route('quiz.show', 1);
    }

    /**
     * Display the specified question by its sequential number (1, 2, 3...).
     */
    public function show($id) // $id is the sequential number (1, 2, 3...)
    {
        $number = (int)$id; 
        $totalQuestions = QuizQuestion::count();

        // Check if the requested number is valid (should not be 0 or too high)
        if ($number < 1 || $number > $totalQuestions) {
            // Agar user ne galat URL enter kiya
            if ($number > $totalQuestions) {
                return redirect()->route('user.dashboard')->with('success', 'Quiz completed!');
            }
            abort(404, 'Invalid Quiz Question Number.');
        }

        // 1. Fetch the question based on its sequential position (OFFSET)
        // orderBy('id') ensures we always follow the creation order.
        // skip($number - 1) makes sure if $number=1, offset is 0 (first question)
        $question = QuizQuestion::orderBy('id')
                                ->skip($number - 1)
                                ->first();

        // 2. Fallback check (though unlikely with the above check)
        if (!$question) {
            abort(404, 'Question not found in the sequence.');
        }
        
        // 3. Get the user's previous answer (for pre-filling/editing)
        $userAnswer = QuizAnswer::where('user_id', Auth::id())
                                ->where('question_id', $question->id)
                                ->first();

        // 4. Save current position in session (optional, for resume logic)
        session(['quiz_current' => $number]);

        // 5. Load the view
        return view('user.quiz', [
            'question' => $question,
            'current' => $number,
            'totalQuestions' => $totalQuestions,
            'userAnswer' => $userAnswer,
        ]);
    }

    /**
     * Store the answer and redirect to the next question.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:quiz_questions,id',
            'current' => 'required|integer|min:1', // Ensure current question number is passed
        ]);

        $question = QuizQuestion::findOrFail($request->question_id);
        $answerData = $request->input('answer');
        
        // --- Dynamic Answer Handling (Your previous logic is fine here) ---
        if ($question->type === 'rating') {
            $request->validate(['answer' => 'required|integer|between:1,5']);
            $answerToStore = $answerData;
        } elseif (is_array($answerData)) {
            $answerToStore = implode(', ', $answerData);
        } else {
             $request->validate(['answer' => 'required|string']);
            $answerToStore = $answerData;
        }
        // ---------------------------------

        QuizAnswer::updateOrCreate(
            ['user_id' => auth()->id(), 'question_id' => $request->question_id],
            ['answer' => $answerToStore]
        );

        $current = $request->input('current');
        $next = $current + 1;
        $totalQuestions = QuizQuestion::count();

        if ($next > $totalQuestions) {
            session()->forget('quiz_current');
            return redirect()->route('user.dashboard')->with('success', 'Quiz completed! Your compatibility profile is now active.');
        }

        // Redirect to the NEXT sequential number
        return redirect()->route('quiz.show', $next);
    }
}