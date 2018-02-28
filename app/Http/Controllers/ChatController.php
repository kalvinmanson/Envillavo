<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Store;
use App\Record;
use Auth;

use Illuminate\Http\Request;

class ChatController extends Controller
{
  public function fetch($record_id, $last)
  {
    return Chat::where('record_id', $record_id)->where('id', '>', $last)->with('record')->get();
  }

  public function send($record_id, Request $request)
  {
    $record = Record::find($record_id);
    $chat = new Chat;
    $chat->record_id = $record->id;
    $chat->chat = $request->chat;
    $chat->save();

    return Chat::where('id', $chat->id)->with('record')->first();
    //broadcast(new MessageSentEvent($record, $chat))->toOthers();
  }
}
