# php-openfire-userservice
Openfire Userservice PHP Wrapper

require ``` "jestillore/php-openfire-userservice": "dev-master" ```

```
use Jestillore\PhpOpenfireUserservice\PHPOpenfireUserservice;

$us = new PHPOpenfireUserservice;
$us->setEndpoint('http://example.com:9090/plugins/userService');
```
There are two available authorization type:
* HTTP Basic Authentication
* Shared Key

To use HTTP Basic Authentication
```
$us->setAuthType(PHPOpenfireUserservice::AUTH_BASIC)
   ->setUsername('username')
   ->setPassword('password');
```

To use Shared key
```
$us->setAuthType(PHPOpenfireUserservice::AUTH_SHARED_KEY)
   ->setSharedKey('thisisthesharedkey');
```

Get all users
=============
```
$us->getAllUsers();
```
Returns an array of users
```
[
    {
        "username": "user1",
        "name": "User One",
        "properties": []
    },
    {
    	"username": "user2",
    	"name": "User Two",
    	"properties": []
    }
]
```

Get user information
====================
```
$us->getUser('username');
```
Returns user object
```
{
    "username": "user1",
    "name": "User One",
    "email": "user@one.com",
    "properties": []
}
```

Create user
===========
```
$user1 = array(
    'username' => 'user1',
    'password' => 'password1'
);

$user2 = array(
    'username' => 'user2',
    'password' => 'password2',
    'name' => 'User Two',
    'email' => 'user@two.com'
);

$res1 = $us->createUser($user1);
$res2 = $us->createUser($user2);
```
Returns an instance of Response class.
```
if($res1->isSuccess()) {
    // account created successfully
}
else {
    // account was not created
    $res1->getMessage(); // information about the error
}
```

Delete user
===========
```
$res = $us->deleteUser('username');
if ($res->isSuccess()) {
    // account deleted
}
else {
    // account not deleted
}
```

Update user
===========
```
$user = array(
    'password' => 'password1'
);
$res = $us->updateUser($user);
if($res->isSuccess()) {
    // account updated
}
else {
    // account not updated
}
```

Lock user
=========
```
$res = $us->lockUser('username');
if($res->isSuccess()) {
    // account locked
}
else {
    // account not locked
}
```

Unlock user
===========
```
$res = $us->unlockUser('username');
if($res->isSuccess()) {
    // account unlocked
}
else {
    // account not unlocked
}
```

Get user groups
===============
```
$groups = $us->getUserGroups('jestillore');
```
Returns an array of groups
```
[
    "group1",
    "group2"
]
```

Add user to groups
===============
```
$groups = array(
	'group1',
	'group2'
);
$res = $us->unlockUser('username', $groups);
if($res->isSuccess()) {
    // user added to groups
}
else {
    // user not added to groups
}
```

TODO
* Remove user from groups
* Get user by property
* Get Roster
* Add Roster Entry
* Delete Roster Entry
* Update Roster Entry
