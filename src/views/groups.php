<div class="row">
    <div class="col-md-10">
        <h3>Groups</h3>
    </div>
    <div class="col-md-2">
        <a href="/groups/create" class="btn">Create Group</a>
    </div>
</div>
<div class="col-lg-4 col-md-12" ng-repeat="item in groups">
    <a href="/groups/{{item.group_id}}">
        <div class="card">
            <div class="card-block">
                <img alt="user-img" class="img-thumb-sm" src="/public/images/profile-pic.png">
                <span style="color: inherit; text-decoration: none; font-size: 20px;">
                    &nbsp <strong>{{item.name}}</strong>
                </span>
            </div>
        </div>
    </a>
</div>