<?php

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
