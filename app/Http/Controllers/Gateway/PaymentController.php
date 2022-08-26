<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use SoapClient;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PaymentController extends Controller
{
    private $MerchantID = null; //Required
    private $Amount = 0; //Amount will be based on Toman - Required
    private $Description = null; // Required
    private $Email = null; // Optional
    private $Mobile = null; // Optional
    private $CallbackURL = null; // Required

    public function __construct()
    {
        parent::__construct();
        $this->MerchantID = config('iroilmarket.MERCHANT_ID');
        $this->CallbackURL = config('iroilmarket.CALLBACKURL');
        $this->Amount = $this->settings['PAYMENT_AMOUNT']['value'];
        $this->Description = $this->settings['PAYMENT_DESCRIPTION']['value'];
        $this->Email = $this->settings['EMAIL']['value'];
        $this->Mobile = $this->settings['MOBILE']['value'];
    }

    public function Pay(Request $request)
    {
        ////////////////////////////////////////////////////////////
        /// در گاه پرداخت

        try {
            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        }catch (\Exception $exception){
            throw new HttpException(503);
        }

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $this->Amount,
                'Description' => $this->Description,
                'Email' => $this->Email,
                'Mobile' => $this->Mobile,
                'CallbackURL' => $this->CallbackURL,
            ]
        );

//Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            Payment::create([
                'user_id' => auth()->user()->id,
                'amount' => $this->Amount,
                'status' => false
            ]);

            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);

        } else {
            echo 'ERR: ' . $result->Status;
        }
    }

    public function Callback()
    {
        $payment = Payment::where([
            ['user_id', '=', auth()->user()->id],
            ['status', '=', false],
        ])->first();

        $MerchantID = $this->MerchantID;
        $Amount = $payment->amount; //Amount will be based on Toman
        $Authority = \request('Authority');

        if (\request('Status') == 'OK') {

            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {

                $payment->update(['status' => true, 'refID' => $result->RefID]);

                echo 'Transaction success. RefID:' . $result->RefID;
            } else {
                $payment->update(['status' => false]);
                echo 'Transaction failed. Status:' . $result->Status;
            }
        } else {

            $payment->update(['status' => false]);
            echo 'Transaction canceled by user';
        }
    }
}
