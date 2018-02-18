var app = angular.module('myApp', []);

app.controller('alb', function($scope,$http) {
	$http.get("http://localhost/Projet-Web_Rush_2/api.php?action=get_list_albums").then(function(response){
		$scope.albums = response.data;
	})	
});

app.controller('artists', function($scope,$http) {
	$http.get("http://localhost/Projet-Web_Rush_2/api.php?action=get_list_artists").then(function(response){
		$scope.artists = response.data;
	})	
});

app.controller('details_alb', function($scope, $http) {
	var name = location.search.substring(1).split('=');
	var url = "http://localhost/Projet-Web_Rush_2/api.php?action=get_albums_by_id&name="+name[1];
	
	$http.get(url).then(function(response){
		$scope.details_alb = response.data;
	})
});

app.controller('tracks_album', function($scope, $http) {
	var name = location.search.substring(1).split('=');
	var url = "http://localhost/Projet-Web_Rush_2/api.php?action=get_tracks_by_album&name="+name[1];
	
	$http.get(url).then(function(response){
		$scope.tracks_album = response.data;
	})
})

app.controller('details_artists', function($scope, $http) {
	var name = location.search.substring(1).split('=');
	var url = "http://localhost/Projet-Web_Rush_2/api.php?action=get_artists_by_id&name="+name[1];
	
	$http.get(url).then(function(response){
		$scope.details_artists = response.data;
	})
});

app.controller('albums_artist', function($scope, $http) {
	var name = location.search.substring(1).split('=');
	var url = "http://localhost/Projet-Web_Rush_2/api.php?action=get_albums_by_artist&name="+name[1];
	
	$http.get(url).then(function(response){
		$scope.albums_artist = response.data;
	})
});

app.controller('rand_artists', function($scope, $http) {
	$http.get("http://localhost/Projet-Web_Rush_2/api.php?action=get_random_albums").then(function(response){
		$scope.random_artists = response.data;
	})	
});

app.controller('list_genres', function($scope, $http) {
	$http.get("http://localhost/Projet-Web_Rush_2/api.php?action=get_list_genres").then(function(response){
		$scope.list_genre = response.data;
	})	
});

app.controller('details_genres', function($scope, $http) {
	var name = location.search.substring(1).split('=');
	var url = "http://localhost/Projet-Web_Rush_2/api.php?action=get_genre_album&name="+name[1];

	$http.get(url).then(function(response){
		$scope.detail_genre = response.data;
	})	
});
