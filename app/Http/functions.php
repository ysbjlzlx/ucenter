<?php

if (!function_exists('success')) {
    function success($data = null)
    {
        $resp = [
            'code' => '00000',
            'message' => 'OK',
        ];
        if (!is_null($data)) {
            $resp['data'] = $data;
        }

        return $resp;
    }
}

if (!function_exists('error')) {
    function error(string $code, string $message = 'ERROR', $data = null)
    {
        $resp = [
            'code' => $code,
            'message' => $message,
        ];
        if (!is_null($data)) {
            $resp['data'] = $data;
        }

        return $resp;
    }
}
