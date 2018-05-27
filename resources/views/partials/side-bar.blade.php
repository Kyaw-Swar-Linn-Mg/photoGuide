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
                    <li class="active"><a href="{{ route('book_table') }}"><i class="fa fa-table"></i> Book Table</a></li>
                    <li class="active"><a href="{{ route('book_transaction') }}"><i class="fa fa-table"></i>Book Transaction Table </a> </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>