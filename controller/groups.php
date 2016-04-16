<?php 
class Groups extends Mvc {
    public function _index($url) {
        new Protect;
        if (!empty($url[0])) {
            if ($url[1] === 'join') {
                $post = Input::post();
                $id = $url[0];

                // TODO: Check for existance of group.

                $token = Token::check($post['token']);

                if (!empty($post) && $token === TRUE) {
                    if (Group::joinAsMember($id)) {
                        echo 'Requested';
                    } else {
                        echo 'Already Requested';
                    }
                } else {
                    if (empty($post)) {
                        echo '
                            <form method="post" action="">
                                <input type="hidden" value="'.Token::generate().'" name="token">
                                <button type="submit" class="btn btn-secondary"><i class="fa fa-user-plus"></i> Join</button>
                            </form>
                        ';
                    }
                    elseif($token === FALSE) {
                        echo 'Security Token Missing';
                    }
                }
            } elseif($url[1] === 'accept') {
                if (!empty(Input::post('username'))) {
                    if (Token::check(Input::post('token'))) {
                        Group::acceptUser($url[0]);
                        echo 'Accepted';
                    } else {
                        echo 'Security Token Missing';
                    }
                } else {
                    echo 'Username Required';
                }
            } elseif($url[1] === 'reject') {
                if (!empty(Input::post('username'))) {
                    if (Token::check(Input::post('token'))) {
                        Group::rejectUser($url[0]);
                        echo 'Rejected';
                    } else {
                        echo 'Security Token Missing';
                    }
                } else {
                    echo 'Username Required';
                }
            } else {
                // TODO: Check for existance of group.
                self::init('GroupModel', 'group', $url);
            }
        } else {
            self::init('GroupsListModel', 'groupsList', $url);
        }
    }

    public function create() {
        // TODO: Validate

        $post = Input::post();
        $token = Token::check($post['token']);
        if (!empty($post['name']) && $token === TRUE) {
            $data = NULL;
            $data['group_id'] = md5(uniqid());
            $data['group_name'] = $post['name'];
            $data['desp'] = $post['desp'];
            $data['status'] = 1;
            $data['time'] = time();

            DB::insert('group', $data);
            DB::insert('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $data['group_id'], 'type' => 'A', 'time' => time(), 'status' => '1'));
            echo 'Group Created';
        } else {
            echo 'Empty or security token missing';
        }
    }
}