<?php 
class Post extends Mvc {
    public function _index($url) {

        $id = $url[0];
        
        if (!empty($url[0])) {
            $data = DB::fetch('post', array('unique_id' => $id));
                        
            if (empty($data)) {
                echo 'Not Found';
                die();
            }
            $user_data = User::getPublicUserData($data->user_id, array('username', 'profile_pic'));
            $username = $user_data->username;
            $profile_pic = $user_data->profile_pic;
            $post_data = $data->post_data;
            $time_raw = $data->time;
            $time = date("d M h:i A", $time_raw);
            
           echo '
                
                <html>

                    <head>
                        <title>Posts</title>
                        <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
                        <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
                        <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
                    </head>
                    <style>
                    
                        body {
                            background-color: white;
                        }
                    </style>

                    <body>
                    <br>
                        <div class="col-sm-6">
                            <div class="col-md-12 post">
                                <br>
                                <div class="row">
                                    <div class="col-md-4 post-head">
                                        <img class="post-thumb" src="/data/images/profile/'.$profile_pic.'.jpg" alt="@"/>
                                        <b>&nbsp @'.$username.'</b>
                                    </div>
                                    <div class="col-md-3 post-time">
                                        '.$time.'
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px;">
                                    <hr>
                                    <div class="col-md-12">
                                        '.$post_data.'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>

                    </html>
           ';
        } else {
            Redirect::to('/');
        }
    }
}