<?php

namespace App\Services;

use App\Models\Response;

class ResponseService
{
    /**
     * Get all responses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            return response()->json([
                'success' => true,
                'data' => Response::all(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching responses: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Additional methods for handling responses can be added here


    /**
     * Get response by ID.
     *
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        try {
            $response = Response::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching response: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get responses by authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByAuthUser()
    {
        try {
            // Verificar que el usuario esté autenticado
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated',
                ], 401);
            }

            $responses = Response::with('question', 'user')
                ->where('user_id', auth()->id())
                ->get();

            return response()->json([
                'success' => true,
                'data' => $responses,
                'count' => $responses->count(),
                'message' => $responses->count() > 0 ? 'Responses retrieved successfully' : 'No responses found for authenticated user'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching responses: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get responses for a specific question by authenticated user.
     *
     * @param string|int $questionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByQuestionAndAuthUser($questionId)
    {
        try {
            // Verificar que el usuario esté autenticado
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated',
                ], 401);
            }

            $responses = Response::with('question', 'user')
                ->where('user_id', auth()->id())
                ->where('question_id', $questionId)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $responses,
                'count' => $responses->count(),
                'message' => $responses->count() > 0
                    ? 'Responses retrieved successfully'
                    : 'No responses found for this question by authenticated user'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching responses: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a new response.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        try {
            $response = Response::create([
                'user_id' => auth()->id(),
                'question_id' => $data['question_id'],
                'answer' => $data['answer'],
            ]);
            return response()->json([
                'success' => true,
                'data' => $response,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating response: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing response.
     *
     * @param string|int $id
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        try {
            $response = Response::findOrFail($id);
            $response->update([
                'question_id' => $data['question_id'],
                'answer' => $data['answer'],
            ]);
            return response()->json([
                'success' => true,
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating response: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a response.
     *
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $response = Response::findOrFail($id);
            $response->delete();
            return response()->json([
                'success' => true,
                'message' => 'Response deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting response: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Debug method to check authentication and response data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function debugAuth()
    {
        try {
            $user = auth()->user();
            $isAuthenticated = auth()->check();
            $userId = auth()->id();

            $allResponses = Response::all();
            $userResponses = $isAuthenticated ? Response::where('user_id', $userId)->get() : collect();

            return response()->json([
                'success' => true,
                'debug_info' => [
                    'is_authenticated' => $isAuthenticated,
                    'user_id' => $userId,
                    'user' => $user,
                    'total_responses_in_db' => $allResponses->count(),
                    'user_responses_count' => $userResponses->count(),
                    'user_responses' => $userResponses,
                    'all_responses' => $allResponses
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Debug error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
