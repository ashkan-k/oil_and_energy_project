<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $objects = Payment::Filter(\request('search'),\request('status'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Payments.list' , compact('objects'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return $this->SuccessRedirect("تراکنش مورد نظر با موفقیت حذف شد." , 'payments.index');
    }
}
