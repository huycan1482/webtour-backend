<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order ;
use App\Tour;
use App\Transport;

class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels; 
    
    public $order;
    public $job;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $job)
    {
        $this->order = $order;
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->job == 'shopping') {
            $order = $this->order;
            $tour = Tour::find($order->tour_id);
            $transport = Transport::find($tour->transport_id);

            return $this->view('mail.shopping', [
                'order' => $order,
                'transport' => $transport->name,
                'tour' => $tour,
            ]);
        } elseif ($this->job == 'passForgot') {
            return $this->view('mail.passForgot', [
                'val' => $this->order,
            ]);
        }
        
    }
}
