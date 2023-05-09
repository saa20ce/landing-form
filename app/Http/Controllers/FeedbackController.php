<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackRecieved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function storeFeedback1(Request $request)
    {
         // Валидация данных
        $validateData = $request->validate([
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/',
        ]);
         // Запись данных в файл
        $this->appendToFile('feedback1.txt', $validateData);

        // Отправка уведомления на email администратора
        $this->sendEmail($validateData);

        // Ответ об успешном приеме заявки
        return response()->json([
            'success' => true,
            'message' => 'Заявка с формы 1 успешно отправлена'
        ]);
    }
    public function storeFeedback2(Request $request)
    {
         // Валидация данных
        $validateData = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/',
        ]);

         // Запись данных в файл
        $this->appendToFile('feedback2.txt', $validateData);

        // Отправка уведомления на email администратора
        $this->sendEmail($validateData);

        // Ответ об успешном приеме заявки
        return response()->json([
            'success' => true,
            'message' => 'Заявка с формы 2 успешно отправлена'
        ]);
    }

    // Файл с заявками, его имя и содержимое
    private function appendToFile($filename, $data)
    {
        $content = '';

        // Принимает ключ массива и значение элемента массива 
        foreach ($data as $key => $value) {
            $content .= ucfirst($key) . ': ' . $value . PHP_EOL;
        }
        
        $content .= '----------' . PHP_EOL;

        // В app/ в файл записывает содержимое   
        File::append(storage_path($filename), $content);
    }

    // Содержимое заявки отправляется на почту админа
    private function sendEmail($feedback)
    {
        $adminEmail = config('mail.admin_email');
        Mail::to($adminEmail)->send(new FeedbackRecieved($feedback));
    }

}
