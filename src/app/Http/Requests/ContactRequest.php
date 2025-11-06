<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'email' => ['required', 'email', 'max:255'],
            'tel'         => ['required', 'regex:/^\d{2,4}-\d{2,4}-\d{3,4}$/'],
            'address' => ['required', 'string', 'max:255'],

            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string', 'max:120'],
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'tel' => ($this->tel1 ?? '') . '-' . ($this->tel2 ?? '') . '-' . ($this->tel3 ?? ''),
        ]);
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel.required'         => '電話番号を入力してください',
            'tel.regex'            => '電話番号の形式が正しくありません（例：080-1234-5678）',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'content.required'     => 'お問い合わせ内容を入力してください',
            'content.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
