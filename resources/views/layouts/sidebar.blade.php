<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('users.form') }}"><span>Create User</span></a></li>
            <li><a href="{{ route('users.index')}}"><span>All Users</span></a></li>
            <li><a href="{{ route('users.approved')}}"><span>Choosed Students</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Choosed Students</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('quiz.form')}}">quiz form</a></li>
                    <li><a href="{{ route('question.form')}}">question form</a></li>
                    <li><a href="{{ route('questions_answer.form')}}">answers form</a></li>
                    <li><a href="{{ route('questions_answer.index')}}">all answers</a></li>
                    <li><a href="{{ route('quiz.index')}}">all quizzes</a></li>
                    <li><a href="{{ route('question.index')}}">all questions</a></li>
                </ul>
            </li> 
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>