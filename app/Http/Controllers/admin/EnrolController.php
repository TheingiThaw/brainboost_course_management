<?php

namespace App\Http\Controllers\admin;

use App\Models\Enrolment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class EnrolController extends Controller
{
    //enrol list page
    public function list(){
        $paymentData = PaymentHistory::select('payment_histories.created_at','payment_histories.enrol_code','payment_histories.user_name','enrolments.status')
                        ->leftJoin('enrolments','enrolments.enrol_code','payment_histories.enrol_code')
                        ->when(request('searchKey'),function($query){
                            $query->where('payment_histories.user_name','like','%'.request('searchKey').'%');
                        })
                        ->distinct()
                        ->get();
        return view('admin.enroll.list', compact('paymentData'));
    }

    //enrol detail page
    public function detail($enrolCode){
        $enrols = Enrolment::select('users.name as user_name', 'users.phone', 'enrolments.enrol_code','enrolments.created_at','enrolments.id','courses.id as course_id','users.id as user_id','courses.image','courses.name as course_name','courses.price')
                    ->leftJoin('users','users.id','enrolments.user_id')
                    ->leftJoin('courses','courses.id','enrolments.course_id')
                    ->where('enrol_code',$enrolCode)->get();

        $paymentHistory = PaymentHistory::where('enrol_code',$enrolCode)->first();

        return view('admin.enroll.detail', compact('enrols', 'paymentHistory'));
    }

    //enrol status on change
    public function onchange(Request $request){
        $enrolCode = $request['enrol_code'];
        $status = $request['status'];

        Enrolment::where('enrol_code',$enrolCode)->update([
            'status' => $status
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    //enrol rejection
    public function enrolReject(Request $request){
        $enrolCode = $request['enrolCode'];
        Enrolment::where('enrol_code',$enrolCode)->update([
            'status' => 2
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    //enrol confirmation
    public function enrolConfirm(Request $request){
        $enrolCode = $request['enrolCode'];
        Enrolment::where('enrol_code',$enrolCode)->update([
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
