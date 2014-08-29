'use strict';

var validationApp = angular.module('validationApp', []);


validationApp.directive('inputMask', function(){
  return {
    restrict: 'A',
    link: function(scope, el, attrs){
      $(el).inputmask(scope.$eval(attrs.inputMask));
      $(el).on('change', function(e){
        scope.$eval(attrs.ngModel + "='" + el.val() + "'");
        console.log(scope);
      });
    }
  };
});

validationApp.controller('faqForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='faq';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){
                    angular.element(document.querySelector('.feedback-form.horizontal')).html('<h3 class="form-title">Ваш вопрос отправлено.</h3>');
                    $scope.user = {};
                    $scope.userForm.$setPristine();
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});

validationApp.controller('feedbackForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='feedback';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){
                    angular.element(document.querySelector('.feedback-form.vertical')).html('<h3 class="form-title">Ваше сообщение отправлено.</h3>');
                    $scope.user = {};
                    $scope.userForm.$setPristine();
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});

validationApp.controller('aktionForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='aktion';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){
                    angular.element(document.querySelector('.feedback-form.horizontal')).html('<h3 class="form-title">Ваша заявка отправлена.</h3>');
                    $scope.user = {};
                    $scope.userForm.$setPristine();
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});

validationApp.controller('ctrlBasket', function($scope,$http) {      
  $scope.clearBasket=function(){
   $http.post('/ajax/',{command:'clearBasket'}).success(function(res){
      if(res=='ok'){
        angular.element(document.querySelector('.cart.simple-page.ng-scope')).html('<p><font class="errortext">Ваша корзина пуста</font></p>');
        angular.element(document.querySelector('.top-cart .value')).text('0');
        angular.element(document.querySelector('.order-form')).addClass('ng-hide');
      }else{alert(res);}
    }).error(function(err){
      alert(err);
    });
  }
  $scope.showOrder=function(){
    angular.element(document.querySelector('.order-form')).removeClass('ng-hide');
  }
});

validationApp.controller('search', function($scope,$http) {   
    $scope.onKeyUp = function () {
      if ($scope.searchForm.$valid) {
            $http.post('/ajax/',{command:'search',value:$scope.val}).success(function(res){
              if(res.result=='ok'){
                angular.element(document.querySelector('.search-with-suggestion')).addClass('result-ok');
                angular.element(document.querySelector('.search-with-suggestion table')).html(res.html);
              }else{alert(res);}
            }).error(function(err){
              alert(err);
            });
        }
    };
    $scope.focus = function () {
        if($scope.searchForm.$valid) angular.element(document.querySelector('.search-with-suggestion')).addClass('result-ok');
    };

    $scope.blur = function () {
        if($scope.fl) angular.element(document.querySelector('.search-with-suggestion')).removeClass('result-ok');
    };
});


validationApp.controller('authForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='auth';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){
                    /*angular.element(document.querySelector('.feedback-form.vertical')).html('<h3 class="form-title">Ваше сообщение отправлено.</h3>');*/
                    $scope.user = {};
                    $scope.userForm.$setPristine();
                    $('#overlay,#auth').fadeOut();
                    location.reload();
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});

validationApp.controller('regForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='reg';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){
                    /*angular.element(document.querySelector('.feedback-form.vertical')).html('<h3 class="form-title">Ваше сообщение отправлено.</h3>');*/
                    $scope.user = {};
                    $scope.userForm.$setPristine();
                    $('#overlay,#auth').fadeOut();
                    location.reload();
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});

validationApp.controller('updateForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='update';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){/*
                    angular.element(document.querySelector('.personal .user')).html('<h3 class="form-title">ваши данные обновленны</h3>');*/
                    location.reload();
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});

validationApp.controller('reviewForm', function($scope,$http) {      
    $scope.submitForm = function() {
        if ($scope.userForm.$valid) {
            $scope.user.command='reviews';
            $http.post('/ajax/',$scope.user).success(function(res){
                if(res=='ok'){
                    angular.element(document.querySelector('.pane .feedback-form')).html('<h3 class="form-title">Отзыв отправлен на модерацию</h3>');
                    $scope.user = {};
                }else{
                    alert(res);
                }
            }).error(function(){
                alert('Ошибка сервера.');
            });
        }
    };
});