<div class="card card-block col-lg-3 prof" ng-controller="profile">
    <div class="col-xs-12">
        <a href="/profile/changepic" ng-hide="!default">
            <div class="img-upload"><img ng-src="/data/images/profile/200/{{userData.profile_pic}}.jpg" alt="{{userData.username}}"/><span><i class="fa fa-upload fa-2x"></i><br>Change Picture</span></div>
        </a>
        <div class="ppic" ng-hide="default"><img ng-src="/data/images/profile/200/{{userData.profile_pic}}.jpg" alt="@{{userData.username}}" class="img-thumb-lg"></div>
    </div>
    <div class="col-xs12 prof-content">
        <div class="row">
            <h3>{{userData.first_name}} {{userData.last_name}}</h3>
            <h5 style="color: gray">@ {{userData.username}}</h5>
        </div>
        <div class="row" ng-hide="default">
            <a class="btn btn-danger m-t-20" ng-click="unfollow()" ng-hide="!following"><i class="fa fa-times"></i> Unfollow</a>
            <a class="btn btn-success m-t-20" ng-click="follow()" ng-hide="following"><i class="fa fa-check"></i> Follow</a>
            <a class="btn btn-success m-t-20" href="/inbox/{{userData.username}}"> <i class="fa fa-envelope"></i> Message</a>
        </div>
    </div>
    <br>
    <div class="col-md-4" style="text-align: center;"><b>Followers</b><br>{{userData.followers}}</div>
    <div class="col-md-4" style="text-align: center;"><b>Questions</b><br>{{userData.questions}}</div>
    <div class="col-md-4" style="text-align: center;"><b>Answers</b><br>{{userData.answers}}</div>
</div>