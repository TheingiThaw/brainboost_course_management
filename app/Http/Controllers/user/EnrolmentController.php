<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Models\Payment_history;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EnrolmentController extends Controller
{
    //enrolment navigation
    public function enrolment(){
        $enrolments = Cart::select('carts.id as cart_id','courses.id','courses.name','courses.image','courses.price','courses.price')
                        ->leftJoin('courses','courses.id','carts.course_id')
                        ->where('user_id',request()->user()->id)->get();
        return view('user.enroll.cart', compact('enrolments'));
    }

    //join course
    public function join($id){
        $userId = request()->user()->id;

        $exists = Cart::where('course_id',$id)
                        ->where('user_id',$userId)
                        ->exists();

        if($exists){
            alert()->warning('You have already added this course to enrolment');
            return back();
        }

        $data = [
            'course_id' => $id,
            'user_id' => $userId
        ];
        Cart::create($data);
        alert()->success('Added to Enrolment!');
        return back();
    }

    //enrolment course delete
    public function delete(Request $request){
        $cartId = $request['cartId'];
        Cart::where('id',$cartId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    //temp Storage before payment
    public function tempStorage(Request $request){
        $tempOrders = json_decode($request['tempOrder']);
        Session::put('tempOrders',$tempOrders);

        return response()->json([
            'status' => 'success'
        ]);
    }

    // to enrol payment page
    public function toEnrolPage(){
        $tempOrders = Session::get('tempOrders');
        // $payments = Payment::OrderBy('type','asc')->get();
        return view('user.enroll.payment', compact('tempOrders',));
    }

    public function enrol(Request $request){

        $request->validate([
            'phone' => 'required|max:12',
            'address' => 'required|max:100',
            'paymentType' => 'required',
            'payslipImage' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ]);

        $paymentData = [
            'user_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->paymentType,
            'enrol_code' => $request->enrolCode,
            'total_amt' => $request->totalAmount,
        ];


        if($request->hasfile('payslipImage')){
            $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
            $request->file('payslipImage')->move(public_path('paymentPhoto'), $fileName);
            $paymentData['payslip_image'] = $fileName;
        }

        PaymentHistory::create($paymentData);
        $Orders = Session::get('tempOrders');

        foreach($Orders as $order){
            $enrolData[] = [
                'user_id' => $order->user_id,
                'course_id' => $order->course_id,
                'status' => 0,
                'enrol_code' => $order->enrol_code
            ] ;
            Cart::where('user_id',$order->user_id)->where('course_id',$order->course_id)->delete();
        }

        foreach($enrolData as $data){
            Enrolment::create($data);
        }

        alert()->success('Enrolment Submitted Successfully');
        return to_route('user#home');
    }

    //to enrol list page
    public function enrolList(){
        $orders = Enrolment::where('user_id',Auth::user()->id)
                    ->distinct()
                    ->get();
        return view('user.enroll.list');
    }
}
