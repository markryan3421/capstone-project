<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreGoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // This is the validation from the controller, used as parameter in the store function in GoalController
        return [
            'project_manager_id' => 'required|exists:users,id',
            'sdg_id' => 'required|exists:sdgs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'         => ['required', 'date', 'after_or_equal:today'],
            'end_date'           => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'type' => 'required|in:short,long',
            'assigned_users.*' => [
                'nullable',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user) {
                        return $fail("Selected user does not exist.");
                    }
                    if ($user->id === Auth::id()) {
                        return $fail("You cannot assign a goal to yourself.");
                    }
                    if (!$user->hasRole('staff')) {
                        return $fail("Only users with the 'staff' role can be assigned.");
                    }
                }
            ],
        ];
    }
}
