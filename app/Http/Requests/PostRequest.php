<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Post;


class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // validation rules
            'title' => ['required','min:3','unique:posts,title,' . $this->id],
            'description' => ['required', 'min:10'],
            'user_id' => ['exists:users,id'], //to make sure that no one hacks you and send an id of post creator that doesn’t exist in the database
            // 'image' => 'required|mimes:jpg,png'
        ];
    }
}
