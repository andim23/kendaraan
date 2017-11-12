<div class="page-sidebar-wrapper">
    <!-- BEGIN HORIZONTAL RESPONSIVE MENU -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-slide-speed="200" data-auto-scroll="true">
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search sidebar-search-bordered" action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn submit"><i class="icon-magnifier"></i></button>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="active">
                <a href="<?= base_url() ?>page">
                Dashboard <span class="selected">
                </span>
                </a>
            </li>
            <li>
                <a href="#">
                Mega <span class="arrow">
                </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">
                        Layouts <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li class="active">
                                <a href="layout_horizontal_sidebar_menu.html">
                                Horizontal & Sidebar Menu </a>
                            </li>
                            <li>
                                <a href="index_horizontal_menu.html">
                                Dashboard & Mega Menu </a>
                            </li>
                            <li>
                                <a href="layout_horizontal_menu1.html">
                                Horizontal Mega Menu 1 </a>
                            </li>
                            <li>
                                <a href="layout_horizontal_menu2.html">
                                Horizontal Mega Menu 2 </a>
                            </li>
                            <li>
                                <a href="layout_fontawesome_icons.html">
                                <span class="badge badge-roundless badge-danger">new</span>Layout with Fontawesome Icons</a>
                            </li>
                            <li>
                                <a href="layout_glyphicons.html">
                                Layout with Glyphicon</a>
                            </li>
                            <li>
                                <a href="layout_full_height_portlet.html">
                                <span class="badge badge-roundless badge-success">new</span>Full Height Portlet</a>
                            </li>
                            <li>
                                <a href="layout_full_height_content.html">
                                <span class="badge badge-roundless badge-warning">new</span>Full Height Content</a>
                            </li>
                            <li>
                                <a href="layout_search_on_header1.html">
                                Search Box On Header 1 </a>
                            </li>
                            <li>
                                <a href="layout_search_on_header2.html">
                                Search Box On Header 2 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_search_option1.html">
                                Sidebar Search Option 1 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_search_option2.html">
                                Sidebar Search Option 2 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_reversed.html">
                                <span class="badge badge-roundless badge-warning">
                                new </span>
                                Right Sidebar Page </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_fixed.html">
                                Sidebar Fixed Page </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_closed.html">
                                Sidebar Closed Page </a>
                            </li>
                            <li>
                                <a href="layout_ajax.html">
                                Content Loading via Ajax </a>
                            </li>
                            <li>
                                <a href="layout_disabled_menu.html">
                                Disabled Menu Links </a>
                            </li>
                            <li>
                                <a href="layout_blank_page.html">
                                Blank Page </a>
                            </li>
                            <li>
                                <a href="layout_boxed_page.html">
                                Boxed Page </a>
                            </li>
                            <li>
                                <a href="layout_language_bar.html">
                                Language Switch Bar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                        More Layouts <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="layout_sidebar_search_option1.html">
                                Sidebar Search Option 1 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_search_option2.html">
                                Sidebar Search Option 2 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_reversed.html">
                                <span class="badge badge-roundless badge-success">
                                new </span>
                                Right Sidebar Page </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_fixed.html">
                                Sidebar Fixed Page </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_closed.html">
                                Sidebar Closed Page </a>
                            </li>
                            <li>
                                <a href="layout_ajax.html">
                                Content Loading via Ajax </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                        Even More <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="layout_disabled_menu.html">
                                Disabled Menu Links </a>
                            </li>
                            <li>
                                <a href="layout_blank_page.html">
                                Blank Page </a>
                            </li>
                            <li>
                                <a href="layout_boxed_page.html">
                                Boxed Page </a>
                            </li>
                            <li>
                                <a href="layout_language_bar.html">
                                Language Switch Bar </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                Full Mega <span class="arrow">
                </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">
                        Layouts <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="index_horizontal_menu.html">
                                Dashboard & Mega Menu </a>
                            </li>
                            <li>
                                <a href="layout_horizontal_sidebar_menu.html">
                                Horizontal & Sidebar Menu </a>
                            </li>
                            <li>
                                <a href="layout_horizontal_menu1.html">
                                Horizontal Mega Menu 1 </a>
                            </li>
                            <li>
                                <a href="layout_horizontal_menu2.html">
                                Horizontal Mega Menu 2 </a>
                            </li>
                            <li>
                                <a href="layout_search_on_header1.html">
                                Search Box On Header 1 </a>
                            </li>
                            <li>
                                <a href="layout_search_on_header2.html">
                                Search Box On Header 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                        More Layouts <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="layout_sidebar_search_option1.html">
                                Sidebar Search Option 1 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_search_option2.html">
                                Sidebar Search Option 2 </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_reversed.html">
                                <span class="badge badge-roundless badge-success">
                                new </span>
                                Right Sidebar Page </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_fixed.html">
                                Sidebar Fixed Page </a>
                            </li>
                            <li>
                                <a href="layout_sidebar_closed.html">
                                Sidebar Closed Page </a>
                            </li>
                            <li>
                                <a href="layout_ajax.html">
                                Content Loading via Ajax </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                        Even More <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="layout_disabled_menu.html">
                                Disabled Menu Links </a>
                            </li>
                            <li>
                                <a href="layout_blank_page.html">
                                Blank Page </a>
                            </li>
                            <li>
                                <a href="layout_boxed_page.html">
                                Boxed Page </a>
                            </li>
                            <li>
                                <a href="layout_language_bar.html">
                                Language Switch Bar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                        Accordions <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <div id="accordion2" class="panel-group mega-menu-responsive-content">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" class="collapsed">
                                            Mega Menu Info #1 </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne2" class="panel-collapse in">
                                            <div class="panel-body">
                                                 Metronic Mega Menu Works for fixed and responsive layout and has the facility to include (almost) any Bootstrap elements.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" class="collapsed">
                                            Mega Menu Info #2 </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                 Metronic Mega Menu Works for fixed and responsive layout and has the facility to include (almost) any Bootstrap elements.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2">
                                            Mega Menu Info #3 </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                 Metronic Mega Menu Works for fixed and responsive layout and has the facility to include (almost) any Bootstrap elements.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a>
                Classic <span class="arrow">
                </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">
                        <i class="fa fa-bookmark-o"></i> Section 1 </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-user"></i> Section 2 </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-puzzle-piece"></i> Section 3 </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-gift"></i> Section 4 </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-table"></i> Section 5 </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                        <i class="fa fa-envelope-o"></i> More options <span class="arrow">
                        </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="#">
                                Second level link </a>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                More options <span class="arrow">
                                </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?= base_url() ?>page">
                                        Third level link </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>page">
                                        Third level link </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>page">
                                        Third level link </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>page">
                                        Third level link </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>page">
                                        Third level link </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>page">
                                Second level link </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>page">
                                Second level link </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>page">
                                Second level link </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">
                Link </a>
            </li>
        </ul>
    </div>
    <!-- END HORIZONTAL RESPONSIVE MENU -->
</div>