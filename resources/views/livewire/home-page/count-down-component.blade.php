<div>
    @if($countdownSale)

    <section class="categories spad">

        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="{{$countdownSale->banner}}" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            @if($countdownSale->sale_type = 'fixed')
                                <h5>${{$countdownSale->value}}</h5>
                            @elseif('percent')
                                <h5>%{{$countdownSale->value}}</h5>
                            @else
                                <h5>{{$countdownSale->value}}</h5>
                            @endif

                        </div>
                    </div>
                </div>

                @if($countdownSale && $end_date > \Carbon\Carbon::now())
                <div class="col-lg-7 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week!</span>
                        <h2>{{$countdownSale->name}}</h2>
                        <div class="categories__deal__countdown__timer">
                            <div class="cd-item">
                                <span id="days" class="countdown_timer" wire:key="days">{{ $days }}</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span id="hours" class="countdown_timer" wire:key="hours">{{ $hours }}</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span id="minutes" class="countdown_timer" wire:key="minutes">{{ $minutes }}</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span id="seconds" class="countdown_timer" wire:key="seconds">{{ $seconds }}</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('sale.product', ['id'=>$countdownSale->id])}}" class="primary-btn slide-btn2">Check It Out</a>
                    @else
                        <h2>Wait for new sale soon</h2>
                </div>
            </div>
                @endif

        </div>
    </section>
    @endif
</div>
