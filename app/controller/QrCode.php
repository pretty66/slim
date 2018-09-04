<?php

namespace app\controller;

use Slim\Http\Request;
use Slim\Http\Response;

class QrCode extends Common
{
    public function getContent(Request $request,Response $response, $args)
    {
        $file = $request->getUploadedFiles();
        dd($file);
    }
}