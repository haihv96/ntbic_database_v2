<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">
                        @yield('linkage.heading.first')</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>@yield('linkage.heading.second')</span>
                </li>
                <li>
                    <span>@yield('linkage.heading.third')</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">
                        Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#"><i class="icon-bell"></i> Action</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-shield"></i> Another action</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-user"></i> Something else here</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="icon-bag"></i> Separated link</a>
                        </li>
                    </ul>
                </div>
            </div>
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