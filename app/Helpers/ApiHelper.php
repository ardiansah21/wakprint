<?php
function responseSuccess(String $message, $data = null, $code = 200)
{
    return response([
        'message' => $message,
        'data' => $data,
    ], $code);
}

function responseError(String $message = "Error", $data = null, $code = 400)
{
    return response([
        'message' => $message,
        'data' => $data,
    ], $code);
}
