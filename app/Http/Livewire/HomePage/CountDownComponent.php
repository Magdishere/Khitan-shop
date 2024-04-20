<?php

namespace App\Http\Livewire\HomePage;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;
use App\Services\TimeService;

class CountDownComponent extends Component
{
    public $days;
    public $hours;
    public $minutes;
    public $seconds;
    public $email;

    public function updateTimeValues($diff)
    {
        $timeValues = TimeService::updateTimeValues($diff);
        extract($timeValues);

        $this->days = $days;
        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    public function render()
    {
        $countdownSale = Sale::with('products')
            ->activeSales()
            ->where('banner_type', 'countdown')
            ->first();

        $ends_at = null;

        if (isset($countdownSale ->end_date)) {
            $ends_at = Carbon::parse($countdownSale->end_date);
        }

        $now = Carbon::now();
        $diff = $ends_at !== null ? $ends_at->diffInSeconds($now) : null;

        $this->updateTimeValues($diff);

        $end_date = $ends_at;


        return view('livewire.home-page.count-down-component',
        [
            'countdownSale' => $countdownSale,
            'end_date' => $end_date
        ]);
    }
}
