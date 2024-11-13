@extends('frontend.master')

@section('title', 'All Blogs - Biddabari')

@section('meta-description', 'Explore all blogs from Biddabari in one place. Discover informative articles, tips, and insights on various topics to support your learning and career goals.')

@section('meta-url', request()->url())

@section('og-url', request()->url())

@section('og-image', 'frontend/logo/favicon/favicon-32x32.png')


@section('body')

<div class="blog-widget-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <h1 class="text-center">আমাদের ব্লগ সমূহ</h1>
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    @forelse($blogs as $blog)
                        <div class="col-lg-4 col-md-4 mt-3">

                            <div class="blog-card">
                                <a href="{{ route('front.blog-details', ['slug' => $blog->slug]) }}"
                                    class="w-100" style="height:280px">
                                    <img src="{{ asset(isset($blog->image) ? $blog->image : 'frontend/logo/biddabari-card-logo.jpg') }}"
                                        alt="Blog" class="w-100 img-fluid" style="height: 280px" /> </a>
                                <div class="content">
                                    <ul>
                                        <li><i class="ri-calendar-todo-fill"></i>
                                            {{ $blog->created_at->format('M d, Y') }} </li>
                                        {{-- <li><i class="ri-price-tag-3-fill"></i> <a
                                                href="{{ route('front.category-blogs', ['id' => $blog->blogCategory->id,'slug' => $blog->blogCategory->slug]) }}">{{
                                                $blog->blogCategory->name }}</a></li>--}}
                                        <li><i class="ri-price-tag-3-fill"></i>
                                            <span>{{ $blog->blogCategory->name }}</span></a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('front.blog-details', ['slug' => $blog->slug]) }}"
                                        class="w-100" style="height:280px">
                                        <h2>
                                            {{-- {!! str()->words(strip_tags($blog->title), 4) !!} --}}
                                            {{Str::limit($blog->title, 30) }}
                                        </h2>
                                        <p>{!! str()->words(strip_tags($blog->body), 6) !!}</p>

                                        <button type="button" class="read-btn">Read More</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="card card-body">
                                <h2 class="text-center">No Blogs Published Yet.</h2>
                            </div>
                        </div>
                    @endforelse

                    @if($blogs->lastPage() > 1)
                        <div class="col-lg-12 col-md-12 text-center">
                            <div class="pagination-area">

                                {{ $blogs->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')
    <script>
        function equalheight() {
            var maxHeight = 0;
            $('.blog-card').each(function (index) {
                if ($(this).height() > maxHeight)
                    maxHeight = $(this).height();
            });
            $('.blog-card').height(maxHeight);
        }
        $(document).ready(function () {
            equalheight();
        });
    </script>
@endpush
