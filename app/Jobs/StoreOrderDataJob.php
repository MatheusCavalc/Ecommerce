<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreOrderDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected String $order_id,
        protected $status_payment,
        protected $status_shipping,
        protected $stripe_payment_id = null,
        protected $email = null
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Order::where('id', $this->order_id)->update([  //queue?job
            'status_payment' => $this->status_payment,
            'stripe_payment_id' => $this->stripe_payment_id,
            'email' => $this->email,
            'status_shipping' => $this->status_shipping
        ]);
    }
}
