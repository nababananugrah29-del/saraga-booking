<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('saraga:watchdog')]
#[Description('Detect expired subscriptions and deactivate venues for new bookings while allowing check-ins.')]
class SubscriptionWatchdog extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredSubscriptions = \App\Models\Subscription::where('expiry_date', '<', now())
            ->where('status_pembayaran', 'verified')
            ->get();

        foreach ($expiredSubscriptions as $sub) {
            $vendor = $sub->vendor;
            if ($vendor) {
                // Deactivate all venues for new bookings (Hide from search)
                // Note: check-in logic in VendorController does NOT require is_active=true
                $vendor->venues()->update(['is_active' => false]);
                $this->info("Deactivated venues for vendor: {$vendor->name} due to expired subscription.");
            }
        }

        $this->info('Subscription watchdog execution completed.');
    }
}
