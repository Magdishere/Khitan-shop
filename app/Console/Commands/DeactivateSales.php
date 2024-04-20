<?php

namespace App\Console\Commands;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeactivateSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales:deactivate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate sales whose time has ended';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {

        $this->info('Deactivating sales...');
        $confirmation = $this->confirm('Are you sure you want to deactivate sales?');

        if ($confirmation) {
            $now = Carbon::now();

            Sale::where('end_date', '<=', $now)
                ->update(['is_active' => 0]);

            $this->info('Sales deactivated successfully.');
        } else {
            $this->info('Operation canceled. No sales were deactivated.');
        }
    }
}
