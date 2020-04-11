<?php

class ErrorController extends Controller
{
    public function index()
    {
        http_response_code(404);
        $this->render('404');
    }
}
