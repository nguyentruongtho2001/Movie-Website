 @extends('layout')
 @section('content')
     <div class="row container" id="wrapper">
         <div class="halim-panel-filter">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-6">
                         <div class="yoast_breadcrumb hidden-xs">
                             <span>
                                 <span>Phim thuộc năm »
                                     @for ($year_bread = 2000; $year_bread <= 2024; $year_bread++)
                                         <span class="breadcrumb_last" aria-current="page"><a title="{{ $year_bread }}"
                                                 href="{{ url('nam/' . $year_bread) }}"> {{ $year_bread }}
                                             </a></span> »
                                     @endfor
                                 </span>
                             </span>
                         </div>
                     </div>
                 </div>
             </div>
             <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                 <div class="ajax"></div>
             </div>
         </div>
         <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
             <section>
                 <div class="section-bar clearfix">
                     <h1 class="section-title"><span>Năm {{ $year }}</span></h1>
                 </div>
                 <div class="halim_box">
                     @foreach ($movie as $key => $mov)
                         <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                             <div class="halim-item">
                                 <a class="halim-thumb" href="{{ route('moviepage', $mov->slug) }}">
                                     <figure><img class="lazy img-responsive"
                                             src="{{ asset('uploads/movie/' . $mov->image) }}" alt="{{ $mov->title }}"
                                             title="{{ $mov->title }}">
                                     </figure>
                                     <span class="status">
                                         @if ($mov->resolution == 0)
                                             HD
                                         @elseif($mov->resolution == 1)
                                             HD+
                                         @else
                                             FHD
                                         @endif
                                     </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                         @if ($mov->vietsub == 0)
                                             Vietsub
                                         @else
                                             Thuyết minh
                                         @endif
                                     </span>
                                     <div class="icon_overlay"></div>
                                     <div class="halim-post-title-box">
                                         <div class="halim-post-title ">
                                             <p class="entry-title">{{ $mov->title }}</p>
                                             <p class="original_title">{{ $mov->name_english }}</p>
                                         </div>
                                     </div>
                                 </a>
                             </div>
                         </article>
                     @endforeach
                 </div>
                 <div class="clearfix"></div>
                 <div class="text-center">
                     {!! $movie->links('pagination::bootstrap-4') !!}
                 </div>
             </section>
         </main>
         <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
             <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                 <div class="section-bar clearfix">
                     <div class="section-title">
                         <span>Top Views</span>
                         <ul class="halim-popular-tab" role="tablist">
                             <li role="presentation" class="active">
                                 <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                     data-type="today">Day</a>
                             </li>
                             <li role="presentation">
                                 <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                     data-type="week">Week</a>
                             </li>
                             <li role="presentation">
                                 <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                     data-type="month">Month</a>
                             </li>
                             <li role="presentation">
                                 <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                     data-type="all">All</a>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <section class="tab-content">
                     <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                         <div class="halim-ajax-popular-post-loading hidden"></div>
                         <div id="halim-ajax-popular-post" class="popular-post">
                             <div class="item post-37176">
                                 <a href="" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                     <div class="item-link">
                                         <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798"
                                             class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                             title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                         <span class="is_trailer">Trailer</span>
                                     </div>
                                     <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                                 </a>
                                 <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                                 <div style="float: left;">
                                     <span class="user-rate-image post-large-rate stars-large-vang"
                                         style="display: block;/* width: 100%; */">
                                         <span style="width: 0%"></span>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </section>
                 <div class="clearfix"></div>
             </div>
         </aside>
     </div>
 @endsection
