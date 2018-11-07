<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;

class CartController extends Controller
{
    public function update()
    {
    	$client = auth()->user();


    	$cart = $client->cart;
    	$cart->status = 'Pendente';
    	$cart->order_date = Carbon::now();
    	$cart->save(); // UPDATE


    	$admins = User::where('admin', true)->get();


    	Mail::to($admins)->send(new NewOrder($client, $cart));


    	$notification = 'Seu pedido foi cadastrado com sucesso, assim que estiver pronto vc receberá um e-mail informando que o pedido está a caminho!';
    	return back()->with(compact('notification'));
    }
}
