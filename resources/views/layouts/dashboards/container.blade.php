<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('dashboards.index')}}">
                        @yield('linkage.heading.first')</a>
                </li>
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="@yield('linkage.heading.second.link')">
                        <span>@yield('linkage.heading.second')</span>
                    </a>
                </li>
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="@yield('linkage.heading.third.link')">
                        <span>@yield('linkage.heading.third')</span>
                    </a>
                </li>
            </ul>
        </div>
        <h1 class="page-title"> @yield('page_title')
            <small>@yield('page_title.small')</small>
        </h1>
        <div class="row">
            <div class="col-md-12">
                @yield('container')
            </div>
        </div>
    </div>
</div>