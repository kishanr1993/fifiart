@extends('frontend.layouts.app')
@section('content')
<main class="main__content_wrapper">
    
    @yield('panel_content_breadcrumb')
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
			@include('frontend.inc.user_side_nav')
                <div class="aiz-user-panel">
				@yield('panel_content')
                </div>
            </div>
        </div>
    </section>
</main>
@endsection