Elecode\SoundCloud\SoundCloud
===============






* Class name: SoundCloud
* Namespace: Elecode\SoundCloud







Methods
-------


### withApi

    mixed Elecode\SoundCloud\SoundCloud::withApi(\Elecode\SoundCloud\Api\ApiAdapter $api)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $api **[Elecode\SoundCloud\Api\ApiAdapter](Elecode-SoundCloud-Api-ApiAdapter.md)**



### authenticate

    mixed Elecode\SoundCloud\SoundCloud::authenticate($clientId, $clientSecret, $username, $password)





* Visibility: **public**


#### Arguments
* $clientId **mixed**
* $clientSecret **mixed**
* $username **mixed**
* $password **mixed**



### isAuthenticated

    mixed Elecode\SoundCloud\SoundCloud::isAuthenticated()





* Visibility: **public**




### getMe

    mixed Elecode\SoundCloud\SoundCloud::getMe()





* Visibility: **public**




### getTracksFromUser

    mixed Elecode\SoundCloud\SoundCloud::getTracksFromUser(\Elecode\SoundCloud\ValueObject\User $user)





* Visibility: **public**


#### Arguments
* $user **[Elecode\SoundCloud\ValueObject\User](Elecode-SoundCloud-ValueObject-User.md)**


