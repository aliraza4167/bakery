<?php

namespace App\Http\Controllers;

use App\Messages;
use App\User;
use Validator;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Messages::find(2)->sender());
        return view('messages', [
            'msgs' => auth()->user()->receivedMessages()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('forms.createMessage', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // VALIDATION OF THE DATA
        $validator = Validator::make($request->all(), [
            'recipients' => 'required|max:255',
            'messageBody' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('messages/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // dd(auth()->user()->name);
        $message = new Messages;
        // $message->sender_id = auth()->user()->id;
        $message->body = $request->messageBody;
        $message->message_read = false;

        $saved = $message->save();

        $message->sender()->attach($message->id, ['sender_id' => auth()->user()->id, 'receiver_id' => $request->recipients]);
        
        if($saved) {
            return redirect('/messages');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
