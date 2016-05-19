var mantaApp = angular.module('mantaApp', []);

mantaApp.controller('mantaController', function($scope, $http){


	$scope.follow = function(username){
		console.log(username);
		$http.post('process_follow.php', {
			poster: username
		}).then(function successCallback(response){
			console.log(response.data);
			// $scope.voteTotal = JSON.parse(response.data);
		}, function errorCallback(response){
			console.log(response);
		});
	}




	$scope.upVote = function(element, vote){
		//console.log('clicked on upVote');
		console.log(element);
		$http.post('process_vote.php', {
			voteDirection: 1,
			idOfPost: element.target.parentElement.id
		}).then(function successCallback(response){
			if(vote == 1){
				if(response.data == 'notLoggedIn'){
				element.target.nextElementSibling.innerHTML = "You must be logged in to vote!";
				}else{
                element.target.nextElementSibling.innerHTML = response.data;
            	}
            }
			console.log(response.data);
			// $scope.voteTotal = JSON.parse(response.data);
		}, function errorCallback(response){
			console.log(response);
		});
	}

	$scope.downVote =function(element, vote){
		$http.post('process_vote.php', {
			voteDirection: vote,
			idOfPost: element.target.parentElement.id
		}).then(function successCallback(response){
			if(vote == -1){
				if(response.data == 'notLoggedIn'){
					element.target.previousElementSibling.innerHTML = "You must be logged in to vote!";
				}else{
                element.target.previousElementSibling.innerHTML = response.data;
            	}
            }
			console.log(response.data);
			$scope.voteTotal = response.data;
		}, function errorCallback(response){
			console.log(response);
		});
	}
});