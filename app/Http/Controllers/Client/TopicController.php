<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic){
        return view('topic.index');
    }

    public function submit(Topic $topic){
        return;
    }

}
