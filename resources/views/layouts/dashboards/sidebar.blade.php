<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false"
            data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
            </li>
            <li class="heading">
                <h3 class="uppercase">Management</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Crawl Data</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('raw-profiles.index')}}" class="nav-link">
                            <span class="title">Raw Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('raw-projects.index')}}" class="nav-link ">
                            <span class="title">Raw Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('raw-patents.index')}}" class="nav-link ">
                            <span class="title">Raw Patents</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('raw-products.index')}}" class="nav-link ">
                            <span class="title">Raw Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('raw-companies.index')}}" class="nav-link ">
                            <span class="title">Raw Companies</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Transfer Data</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('profiles.index')}}" class="nav-link">
                            <span class="title">Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('projects.index')}}" class="nav-link ">
                            <span class="title">Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('patents.index')}}" class="nav-link ">
                            <span class="title">Patents</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}" class="nav-link ">
                            <span class="title">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('companies.index')}}" class="nav-link ">
                            <span class="title">Companies</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>