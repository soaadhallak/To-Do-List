<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
   public $aws_secret_key = "AKIAIMNO7YBX3TOFB98Q";

   public function test(Request $request) {
    // ثغرة XSS: طباعة مدخلات المستخدم مباشرة دون فلترة
    echo "User Input: " . $request->query('name'); 
}
}
