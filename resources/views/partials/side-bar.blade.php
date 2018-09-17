<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('basic_photo') }}"><i class="fa fa-photo"></i>Basic Photography </a></li>
                    <li class="active"><a href="{{ route('landscape_photo') }}"><i class="fa fa-photo"></i>Landscape Photography </a> </li>
                    <li class="active"><a href="{{ route('portrait_photo') }}"><i class="fa fa-photo"></i>Portrait Photography </a> </li>
                    <li class="active"><a href="{{ route('category') }}"><i class="fa fa-list"></i>Create Category </a> </li>
                    <li class="active"><a href="{{ route('post') }}"><i class="fa fa-upload"></i>Create Post </a> </li>
                    <li class="active"><a href="{{ route('post_table') }}"><i class="fa fa-table"></i>Post Table</a> </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>