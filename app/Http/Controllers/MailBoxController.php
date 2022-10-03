<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailBox;
use App\Models\UserEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailBoxController extends Controller
{
    public function index(){
        $mailBox = MailBox::where('user_id', Auth::id())->first();
        if($mailBox == null){
            $mailBox = MailBox::create([
                'user_id' => Auth::id(),
                'name' => 'Default'
            ]);
        }
        return view('mailbox.index', compact('mailBox'));
    }

    public function inbox($mailboxId){
        $userEmails = UserEmail::where('receiver_email', Auth::user()->email)->orderBy('id', 'DESC')->get();
        return view('mailbox.inbox', compact('userEmails'));
    }

    public function sentBox($mailboxId){
        $userEmails = UserEmail::with('sender')->where('mail_box_id', $mailboxId)->where('sender_id', Auth::id())->orderBy('id', 'DESC')->get();
        //dd($userEmails);
        return view('mailbox.sentbox', compact('userEmails'));
    }

    public function sendEmail(Request $request, $mailboxId){
    
        $mailBox = MailBox::find($mailboxId);
        
        if($request->method() == 'POST'){
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'subject' => 'required',
                'message_body' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            UserEmail::create([
                'mail_box_id' => $mailboxId ?? null,
                'sender_id' => Auth::id(),
                'receiver_email' => $request->input('email'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message_body')
            ]);
            try{
                $mailData = array(
                    'username' => Auth::user()->name,
                    'messageBody' => $request->input('message_body'),
                    'subject' => $request->input('subject'),
                    'to' => $request->input('email')
                );
                Mail::send('emails.mailbox-email', $mailData, function($message) use($mailData){
                    $message->to($mailData['to'])->subject($mailData['subject']);
                });
                return redirect()->back()->with('success', "Email Sent Successfully");
            }catch(\Exception $ex){
                return redirect()->back()->with('error', $ex->getMessage());
            }
        }
        return view('mailbox.send-email', compact('mailBox'));
    }

    public function emailById($id){
        $userEmail = UserEmail::with('sender')->findOrFail($id);
        return view('mailbox.email-detail', compact('userEmail'));
    }
}
