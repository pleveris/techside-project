<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Type;
use App\Models\Computer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::Notapproved()->paginate();
    
        return view('admin.order.index')->with('orders', $orders);
    }
    
    public function approveOrder(Order $order)
    {
        $order->update(['approved' => true]);

        return redirect()->route('admin.order.index')->with('meesage', 'Ordder has been approved!');
    }
    public function edit(Order $order)
    {
        $computers = $order->computers()->get()->implode('computer', ',');
        $types = $order->types()->get()->implode('type', ',');

        $order->computers = $computers;
        $order->types = $genres;
        return view('admin.order.edit')->with('order', $order);
    } 
    public function update(CreateOrrderRequest $request, Order $order)
    {   
        $request->validate([ 'promo' => 'min:0|max:50']);
        
        if($request->hasFile('picture'))
        {
            if(File::exists( public_path($order->picture)) )
            {
                File::delete(public_path($order->picture));
            }
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('uploads/pics/', $filename);

            $resizedImage = Image::make( public_path('uploads/pics/' . $filename))
            ->fit(400,400)->save();
        }else {
            $filename = str_replace('uploads/pics/', '', $book->picture);
        }

        $computers = explode(',',$request->computer);
        $types = explode(',',$request->type);      

        $order->computers()->detach();
        $order->types()->detach();

        foreach($computers as $computer)
        {   
            $computerCheck = Computer::where('computer', $computer)->firstOrCreate([ 'computer' => $computer]);

            $computerCheck->orders()->attach($order);
        }
        foreach($types as $type)
        {
            $typeCheck = Type::where('type', $type)->firstOrCreate([ 'type' => $type]);

            $typeCheck->orders()->attach($order);
        }

        $order->update([
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'picture' => 'uploads/pics/'. $filename,
            'approved' => true,
            'promo' => $request->promo
        ]);
         return redirect()->route('admin.order.edit', $order)->with('message', 'Order was succesfully updated!');
    }
}
