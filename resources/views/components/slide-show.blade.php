<?php
use App\Models\Slider; 
$list = Slider::all(); 
?>
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php $index = 1; ?>
            @isset($list)
                @foreach ($list as $slider)
                    @if ($index == 1)
                        <div class="item-slick1 active" style="background-image: url(images/slider/{{ $slider->image }});">
                    @else
                        <div class="item-slick1" style="background-image: url(images/slider/{{ $slider->image }});">
                    @endif

                </div>
                <?php $index++; ?>
                @endforeach
            @endisset
        </div>
    </div>
</section>