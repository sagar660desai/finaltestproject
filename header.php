<div class="layout-header">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="index.html">
                <!--<img class="navbar-brand-logo" src="img/logo-inverse.svg" alt="Elephant">-->
            </a>

            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
                    <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
                </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                        <span class="bar-line bar-line-1 out"></span>
                        <span class="bar-line bar-line-2 out"></span>
                        <span class="bar-line bar-line-3 out"></span>
                        <span class="bar-line bar-line-4 in"></span>
                        <span class="bar-line bar-line-5 in"></span>
                        <span class="bar-line bar-line-6 in"></span>
                    </span>
                </button>
                <ul class="nav navbar-nav navbar-right">


                    <li class="dropdown hidden-xs">
                        <span>
                            <?php
                            echo $name;
                            ?> 
                            <!--hii-->
                        </span> 
                        
                        <ul class="dropdown-menu dropdown-menu-right">

                            <li></li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs">
                     <a href="signout.php?<?php
                        if (isset($_SESSION['admin'])) {
                            echo 'admin';
                        } elseif (isset($_SESSION['manager'])) {
                            echo 'manager';
                        } elseif (isset($_SESSION['artist'])) {
                            echo 'artist';
                        }
                        ?>">Sign out</a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
</div>