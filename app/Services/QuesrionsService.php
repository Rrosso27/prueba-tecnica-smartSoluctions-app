<?php

namespace App\Services;

use App\Models\Quesrions;

class QuesrionsService
{
    /**
     * get all questions
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        try {
            return response()->json([
                'success' => true,
                'data' =>  Quesrions::all(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching questions: ' . $e->getMessage(),
            ], 500);
        }
    }


    /** get by id question
     *  @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getById(int $id)
    {
        try {
            $question = Quesrions::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $question,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching question: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a new question
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        try {
            $question = Quesrions::create($data);
            return response()->json([
                'success' => true,
                'data' => $question,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating question: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $question = Quesrions::findOrFail($id);
            $question->update($data);
            return response()->json([
                'success' => true,
                'data' => $question,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating question: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a question
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $question = Quesrions::findOrFail($id);
            $question->delete();
            return response()->json([
                'success' => true,
                'message' => 'Question deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting question: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all questions  of  surveys_id
     * @param int $perPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllBySurveyId(int $surveyId, int $perPage = 10)
    {
        try {
            $questions = Quesrions::where('survey_id', $surveyId)->paginate($perPage);
            return response()->json([
                'success' => true,
                'data' => $questions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching questions: ' . $e->getMessage(),
            ], 500);
        }
    }
}
