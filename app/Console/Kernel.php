<?php

use App\Models\Bills\Bill;
use App\Notifications\BillOverdueNotification;

protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $overdueBills = Bill::where('due_date', '<', now())
            ->where('status', 'unpaid')
            ->get();

        foreach ($overdueBills as $bill) {
            // Kirim notifikasi
            $bill->user->notify(new BillOverdueNotification($bill));

            // Update status
            $bill->update(['status' => 'overdue']);
        }
    })->daily();
}
