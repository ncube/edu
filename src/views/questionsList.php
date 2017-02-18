<a href="/questions/ask" class="btn">Ask Question</a>
<div class="col-lg-6 col-md-12" ng-repeat="item in questions">
    <div class="card">
        <div class="card-block">
            <a href="/questions/{{item.q_id}}" style="color: inherit; text-decoration: none;">
                <h5><strong>{{item.title}}</strong></h5>
            </a>
        </div>
        <div class="question-footer">
            <div class="row">
                <div class="col-md-8">
                    <div class="pull-left" style="padding: 10px; font-size: 17px;" id="{{item.q_id}}">
                        <i class="fa fa-caret-up voteup {{item.my_data.vote_up_class}}"></i> {{item.up_count}} &nbsp
                        <i class="fa fa-comments"></i> {{item.answers}} &nbsp
                        <i class="fa fa-eye"></i> {{item.views}} &nbsp
                    </div>
                </div>
                <div class="col-md-1">
                    <img ng-src="/data/images/profile/35/{{item.user_data.profile_pic}}.jpg" alt="@{{item.username}}" class="img-thumb-sm pull-right">
                </div>
                <div class="col-md-3">
                    <div class="post-head">
                        <a href="/profile/{{item.user_data.username}}"><b>{{item.user_data.first_name}} {{item.user_data.last_name}}</b></a>
                        <br>
                        <span class="time">{{item.time}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>