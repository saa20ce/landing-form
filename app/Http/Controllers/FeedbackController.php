<?php

namespace App\Http\Controllers;

use App\DTOs\FeedbackDTO;
use App\Services\FeedbackService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class FeedbackController extends Controller
{
    private FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }
    public function storeFeedback1(Request $request)
    {
        try{
        $dto = new FeedbackDTO($request->all());

        $this->feedbackService->processFeedback(get_object_vars($dto), 'feedback1.txt');
        
        return response()->json([
            'success' => true,
            'message' => 'Feedback form first successful send',
            'phone' => $dto->phone
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error',
            'errors' => $e->errors()
        ], 400);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error',
            'errors' => ['general' => $e->getMessage()]
        ], 500);
    }
    }
    public function storeFeedback2(Request $request)
    {
        $dto = new FeedbackDTO($request->all());

        $this->feedbackService->processFeedback(get_object_vars($dto), 'feedback2.txt');

        // Ответ об успешном приеме заявки
        return response()->json([
            'success' => true,
            'message' => 'Заявка с формы 2 успешно отправлена'
        ]);
    }

}
