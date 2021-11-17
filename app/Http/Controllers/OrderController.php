<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Type;
use App\Models\Computer;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{   

    public function index()
    {
        //Dont have function now
        if(request('search')){
            $search = request('search');
            Cookie::queue('search' ,$search, 2592000);
        }

        $orders = Order::with('computers')
        ->approved()
        ->when(
            request('search'), function($query)
            {
                $search = request('search');

                $query->where( function($query) use ($search) 
                {
                    $query->where('title','LIKE','%'.$search.'%');
                    $query->orWhereHas('computers' ,function($query) use ($search) 
                    {
                        $query->where('computer', 'LIKE','%'.$search.'%');
                    });
            })->paginate();
        })
        ->latest('id')
        ->paginate();

        return view('guest.order.index', compact('orders'));
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.order.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {  
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('uploads/pics/', $filename);

            $resizedImage = Image::make( public_path('uploads/pics/' . $filename))
            ->fit(400,400)->save();
        }else {
            $filename = 'default.png';
        }

        $order = Order::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'level' => $request->level,
            'picture' => 'uploads/pics/'.$filename,
        ]);

        $computers = explode(',',$request->computer);
        $types = explode(',',$request->type);

        foreach($computers as $computer)
        {
            $computerCheck = Computer::firstOrCreate([ 'computer' => $computer]);

            $computerCheck->orders()->attach($order);
        }
        foreach($types as $type)
        {
            $typeCheck = Type::firstOrCreate(['type' => $type]);

            $typeCheck->orders()->attach($order);
        }
            return redirect()->route('user.order')->with('message', 'Order was successfully created!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('guest.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {

        $computers = $order->computers()->get()->implode('computer', ',');
        $types = $order->types()->get()->implode('type', ',');

        $order->computers = $computers;
        $order->types = $types;

        return view('user.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOrderRequest $request, Order $order)
    {
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
            $filename = str_replace('uploads/pics/', '', $order->picture);
        }

        $computers = explode(',',$request->computer);
        $types = explode(',',$request->type);      

        $order->computers()->detach();
        $order->types()->detach();

        foreach($computers as $computer)
        {   
            $computerCheck = Computer::firstOrCreate([ 'computer' => $computer]);

            $computerCheck->orders()->attach($order);
        }
        foreach($types as $type)
        {
            $typeCheck = Type::firstOrCreate([ 'type' => $type]);

            $typeCheck->orders()->attach($order);
        }
        
        $order->update([
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'picture' => 'uploads/pics/'. $filename,
            'approved' => false,
        ]);

        return redirect()->route('order.edit', $order->id)->with('message', 'Order was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->computers()->detach();
        $order->types()->detach();
        //add delete picture from order (if any)
        if($order->picture != 'uploads/pics/default.png'){
            if(File::exists( public_path($order->picture)) )
            {
                File::delete(public_path($order->picture));
            }
        }

        $order->delete();

        return redirect()->route('admin.order.index')->with('message', 'Success');
    }
}
