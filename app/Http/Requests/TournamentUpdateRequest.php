<?php

namespace App\Http\Requests;

class TournamentUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->tournament ? $this->tournament->id : '';
        return $rules = [
            'slug' => 'required|max:255|unique:tournaments,slug,' . $id
        ];
    }
}
