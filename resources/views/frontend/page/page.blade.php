<?php
use App\Models\Page; 
$list = Page::all(); 
?>

<section class="body">
    <div class="container shadow my-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @php
                    $index = 1;
                @endphp
                @foreach ($list as $item)
                    @if ($index == 1)
                        <button class="nav-link active" id="nav-home-{{ $item->id }}" data-bs-toggle="tab"
                            data-bs-target="#nav-{{ $item->id }}" type="button" role="tab"
                            aria-controls="nav-{{ $item->id }}" aria-selected="true">{{ $item->title }}</button>
                    @else
                        <button class="nav-link " id="nav-home-{{ $item->id }}" data-bs-toggle="tab"
                            data-bs-target="#nav-{{ $item->id }}" type="button" role="tab"
                            aria-controls="nav-{{ $item->id }}" aria-selected="true">{{ $item->title }}</button>
                    @endif
                    @php
                        $index++;
                    @endphp
                @endforeach
            </div>
        </nav>
        <div class="tab-content py-5" id="nav-tabContent">
            @php
                $index = 1;
            @endphp
            @foreach ($list as $item)
                @if ($index == 1)
                    <div class="tab-pane fade show active" id="nav-{{ $item->id }}" role="tabpanel"
                        aria-labelledby="nav-home-{{ $item->id }}" tabindex="0">
                        <picture>
                            <img src="{{ asset('images/page/' . $item->image) }}" alt="">
                        </picture>
                        {!! $item->detail !!}
                    </div>
                @else
                    <div class="tab-pane fade show " id="nav-{{ $item->id }}" role="tabpanel"
                        aria-labelledby="nav-home-{{ $item->id }}" tabindex="0">
                        <picture>
                            <img src="{{ asset('images/page/' . $item->image) }}" alt="">
                        </picture>
                        {!! $item->detail !!}
                    </div>
                @endif
                @php
                    $index++;
                @endphp
            @endforeach

        </div>
   
</section>
