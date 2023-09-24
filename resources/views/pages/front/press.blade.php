@extends('layouts.app')

@section('content')
<main class="bg-gray">
    <section class="press-main-section">
        <div class="container">
            <div class="press-block-container">
                <div class="press-block">
                    <h1>XXSIM on the press</h1>
                    <p class="title-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s</p>
                    <div class="read-more-section">
                        <div class="row">
                            @foreach($presses as $language => $all_press)
                                <div class="col-md-6">
                                    <h2>In {{ ucwords($language) }}</h2>
                                    @foreach($all_press as $press)
                                        <div class="read-more-block">
                                            <p>{{ $press['title'] }}</p>
                                            <a href="{{ $press['link'] }}" class="read-more-btn" target="_blank"><span>read more</span></a>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="press-block">
                    <h1>XXSIM on the television</h1>
                    <p class="title-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s</p>
                    <div class="read-more-section">
                        <div class="row">
                            @foreach($televisions as $language => $all_televisions)
                                <div class="col-md-6">
                                    <h2>In {{ ucwords($language) }}</h2>
                                    @foreach($all_televisions as $television)
                                        <div class="read-more-block">
                                            <p>{{ $television['title'] }}</p>
                                            <a href="{{ $television['link'] }}" class="read-more-btn" target="_blank"><span>read more</span></a>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection