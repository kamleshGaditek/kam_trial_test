<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::all();
        return view('home', compact('services'));
    }

    public function transacHistory(){
        $payments = Payment::where('user_id', Auth::id())->get();
        return view('transac-history', compact('payments'));
    }

    public function purchase(Request $request){ 
        $this->validate($request, [
            'service' => 'required',
            'card_number' => 'required',
            'expiration_month' => 'required',
            'expiration_year' => 'required',
            'cvc' => 'required'
        ]);

        $service = Service::find($request->input('service'));
        //$stripe = \Stripe\Stripe::setApiKey(env('STRIPE_PUBLISHABLE_KEY'));dd($stripe);
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
          );
        try{
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->input('card_number'),
                    'exp_month' => $request->input('expiration_month'),
                    'exp_year' => $request->input('expiration_year'),
                    'cvc' => $request->input('cvc')
                ]
            ]);
            if (isset($token['id'])){
                $charge = $stripe->charges->create([
                    'amount' => $service->price*100,
                    'currency' => 'usd',
                    'source' => $token['id'],
                    'description' => $service->name.' Payment'
                ]);
                if($charge['status'] == 'succeeded'){
                    Payment::create([
                        'user_id' => Auth::id(),
                        'service_id' => $service->id,
                        'amount' => $service->price
                    ]);
                    $mailData = array(
                        'username' => Auth::user()->name,
                        'service_name' => $service->name,
                        'price' => $service->price
                    );
                    try{
                        Mail::send('emails.service-purchase', $mailData, function($message){
                            $message->to(Auth::user()->email)->subject('Service Purchased');
                        });
                    }catch(\Exception $ex){
                        return redirect()->back()->with('error', 'Payment Successfull, but email sent failed');
                    }
                    
                    return redirect()->back()->with('success', 'Payment Successfull');
                }
            }
            return redirect()->back()->with('error', 'Exception Occurred');
        }catch (\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
