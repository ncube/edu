<div class="flex-column-fixed hidden-sm-down" id="side-menu">
    <div class="navbar-v-fluid">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-item">
                <a href="/" class="nav-link<?=$data['side_active']['home']?>"><i class="fa fa-home nav-icon"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?=$data['side_active']['profile']?>" href="/profile"><i class="fa fa-user nav-icon"></i> <span> Profile</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=$data['side_active']['requests']?>" href="/requests"><i class="fa fa-user-plus nav-icon"></i> <span> Requests</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=$data['side_active']['inbox']?>" href="/inbox"><i class="fa fa-envelope nav-icon"></i> <span> Inbox</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=$data['side_active']['questions']?>" href="/questions"><i class="fa fa-question nav-icon"></i> <span> Questions</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link<?=$data['side_active']['settings']?>" href="/settings"><i class="fa fa-cogs nav-icon"></i> <span> Settings</span> </a>
            </li>
        </ul>
    </div>
</div>