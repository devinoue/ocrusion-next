<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageDir;
use App\OcrText;
use App\State;
use App\Queue;

use App\BatchErrorLog;


class DevelopController extends Controller
{
    // userID指定で
    function index (){
        $id=1;
        $page=1;
        $page = ($page * 5);
        $image_dirs = ImageDir::where('user_id', $id)->orderBy('created_at','desc')->paginate($page);
        return($image_dirs);
    }
}
