<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $user = auth()->user();
        $orders = Order::all();
        if ($user->role == 'admin') {
            return view('orders.index')
                ->with('orders', $orders)
                ->with('user', $user);
        }
        return view('orders.index')
            ->with('orders', $orders->where('user_id', '==', $user->id));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'quantity' => 'required|numeric',
            'product_id' => 'required|numeric'
        ]);
        $valid['time_of_order'] = date('Y-m-d h:i:s');
        $valid['user_id'] = auth()->user()->id;
        $order = Order::create($valid);
        return to_route('orders.show', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Application|Factory|View
     */
    public function show(Order $order)
    {
        $user = User::all()->where('id', '==', $order->user_id)->first();
        $product = Product::all()->where('id', '==', $order->product_id)->first();
        return view('orders.show')
            ->with('order', $order)
            ->with('product', $product)
            ->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return to_route('orders.index');
    }
}
