<?php namespace Fetch\v1\Services;

use Validator as V;

class Validator {

    protected $errors;

    public function authStore($input)
    {
        $rules = [
            'phone'        => 'required',
            'country_code' => 'required'
        ];

        return $this->validate($input, $rules);
    }

    public function authVerify($input)
    {
        $rules = [
            'phone' => 'required',
            'pin'   => 'required'
        ];

        return $this->validate($input, $rules);
    }

    public function authStoreUser($input)
    {
        $rules = [
            'username' => 'required|alpha_num|min:3|max:16|unique:users',
            'name'     => 'required|min:3|max:30',
            'pin_token'    => 'required',
            'phone'    => 'required',
        ];

        return $this->validate($input, $rules);
    }

    public function drawingCreateDrawing($input)
    {
        $rules = [
            'userid'        => 'required',
            'to_phone_hash' => 'required',
            'pages'       => 'required',
            'width'         => 'required',
            'height'        => 'required',
            'line_color'    => 'required',
            'bg_color'      => 'required',
        ];

        return $this->validate($input, $rules);
    }

    public function drawingCreateLinkable($input)
    {
        $rules = [
            'userid'        => 'required',
            'pages'         => 'required',
            'width'         => 'required',
            'height'        => 'required',
            'line_color'    => 'required',
            'bg_color'      => 'required',
            'version'       => 'required',
        ];

        return $this->validate($input, $rules);
    }

    public function drawingMissingPhones($input)
    {
        $rules = [
            'userid'         => 'required',
            'missing_phones' => 'required',
        ];

        return $this->validate($input, $rules);
    }

    public function inboxIndex($input)
    {
        $rules = [
            'phone_hash' => 'required',
        ];

        return $this->validate($input, $rules);
    }

    private function validate($input, $rules)
    {
        $validator = V::make($input, $rules);

        if ($validator->fails())
        {
            $this->errors = $validator->messages();
            return FALSE;
        }

        return TRUE;
    }

    public function errors()
    {
        return $this->errors;
    }

} 