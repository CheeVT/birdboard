<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class ProjectInvitationRequest extends FormRequest
{

    protected $errorBag = 'invitations';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('manage', $this->route('project'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', Rule::exists('users', 'email')]
        ];
    }

    public function messages() {
        return [
            'email.exists' => 'The user you are inviting must have a Birdboard account.'
        ];
    }
}
