<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $products;
    public $cus_name;
    public $total;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products,$cus_name,$total)
    {
        //
        $this->products=$products;
        $this->cus_name=$cus_name;
        $this->total=$total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail order from shop cake')->view('emailorder');
    }
}