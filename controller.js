var mantaApp = angular.module('mantaApp', []);

mantaApp.controller('mantaController', function($scope, $http){


	$scope.follow = function(username, followMethod){
		$http.post('process_follow.php', {
			poster: username,
			followMethod: followMethod
		}).then(function successCallback(response){
			console.log(response.data);
			location.reload();
		}, function errorCallback(response){
			console.log(response);
		});		
	}




	$scope.upVote = function(element, vote){
		//console.log('clicked on upVote');
		console.dir(element);
		$http.post('process_vote.php', {
			voteDirection: 1,
			idOfPost: element.target.parentElement.id
		}).then(function successCallback(response){
			if(vote == 1){
				if(response.data == 'notLoggedIn'){
				element.target.parentNode.firstElementChild.innerHTML = "You must be logged in to vote!";
				}else{
                element.target.parentNode.firstElementChild.innerHTML = response.data;
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
					element.target.parentNode.firstElementChild.innerHTML = "You must be logged in to vote!";
				}else{
                element.target.parentNode.firstElementChild.innerHTML = response.data;
            	}
            }
			console.dir(target);
			$scope.voteTotal = response.data;
		}, function errorCallback(response){
			console.log(response);
		});
	}
});