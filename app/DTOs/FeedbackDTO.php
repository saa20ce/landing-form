<?php

namespace App\DTOs;

class FeedbackDTO
{
    public string $phone;
    public ?string $name;

    public function __construct(array $data)
    {
        $this->validate($data);

        $this->phone = $data['phone'];
        $this->name = $data['name'] ?? null;
    }

    private function validate(array $data): void
    {
        $rules = [
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/',
            'name' => 'nullable|regex:/^[\pL\s]+$/u',
        ];

        $validator = validator($data, $rules);
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
}
