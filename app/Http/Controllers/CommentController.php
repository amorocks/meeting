<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Task;
use App\Comment;

class CommentController extends Controller
{
    public function store_topic(Topic $topic, Request $request)
    {
    	$this->store($topic, $request);
    	return redirect()->back();
    }

    public function store_task(Task $task, Request $request)
    {
    	$this->store($task, $request);
    	return redirect()->back();
    }

    private function store($commentable, Request $request)
    {
    	$request->validate(['comment' => 'required']);
    	$comment = new Comment();
    	$comment->author = 'user_todo';
    	$comment->text = $request->comment;

    	$commentable->comments()->save($comment);
    }
}
