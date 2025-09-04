<?php

namespace App\Controllers;

class Main extends BaseController
{
    public function index(): string {
        return view('main_page', [
            "current_page" => "main_page",
            "common_data" => view_common_data()
        ]);
    }
}
