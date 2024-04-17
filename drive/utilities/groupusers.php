<?php
include 'users.php';

$new_users = $_USERS;

foreach ($_USERS as $key => $user) {
	if ($user['role'] == 'user' ) {
		$new_users[$key]['dir'] = '["A","C","E"]';
	}
}

echo "<pre>";
print_r($new_users);
echo "</pre>";

$usrs = '$_USERS = ';

echo "<hr>";

if ( false == (file_put_contents(
    'group-users.txt', "<?php\n\n $usrs".var_export($new_users, true).";\n"
))
) {
    echo '<div class="alert alert-error" role="alert">error creating <strong>users-new.php</strong></div>';
} else {
    echo '<div class="alert alert-success" role="alert">users created inside <strong>group-users.txt</strong></div>';
}