<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class DeleteCancelledOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * You will run this as:
     * php artisan app:delete-cancelled-orders
     */
    protected $signature = 'app:delete-cancelled-orders';

    /**
     * The console command description.
     */
    protected $description = 'Delete all cancelled orders older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Order::where('status', 'cancelled')
            ->where('cancelled_at', '<=', now()->subHours(24))
            ->delete();

        $this->info('Cancelled orders older than 24 hours deleted.');
    }
}
