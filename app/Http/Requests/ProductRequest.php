<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //'company_id' => 'required|numeric',
            'company_name' => 'required',
            'product_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'required',
            'contact' => 'required',
            'image' => 'exclude_unless:contact,1|required','image',
        ];
    }

    public function attributes()
    {
        return [
            //'company_id' => 'メーカーID',
            'company_name' => 'メーカー名',
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫',
            'comment' => 'コメント',
            'image' => '画像',
            'contact' => '変更の有無',
        ];
    }

    public function messages() {
        return [
            'company_id.required' => ':attributeは必須項目です。',
            'company_name.required' => ':attributeは必須項目です。',
            'product_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'price.numeric' => ':attributeは数字で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.numeric' => ':attributeは数字で入力してください。',
            'comment.required' => ':attributeは必須項目です。',
            'image.required' => ':attributeは必須項目です。',
            'image.image' => ':attributeは写真ファイルを選択して下さい。',
            'contact.required' => ':attributeはどちらか選択してください。',
        ];
    }
}
