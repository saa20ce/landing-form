<?php

namespace App\Services;

use App\Mail\FeedbackRecieved;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class FeedbackService
{
    public function processFeedback(array $data, string $filename): void
    {
        $this->appendToFile($filename, $data);
        //$this->sendEmail($data);
    }

    private function appendToFile($filename, $data): void
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

    // Отправка письма админу
    // private function sendEmail($feedback): void
    // {
    //     $adminEmail = config('mail.admin_email');
    //     Mail::to($adminEmail)->send(new FeedbackRecieved($feedback));
    // }
}
