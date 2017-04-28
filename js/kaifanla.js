/**
 * Created by Administrator on 2017/1/23 0023.
 */
angular.module('kaifanla',['ng','ngRoute','ngAnimate']).
  controller('parentCtrl',function($scope,$location){
  $scope.jump=function(routeUrl){
    $location.path(routeUrl);
  }
}).
  controller('startCtrl',function($scope){
}).
  controller('mainnCtrl',function($scope,$http){
  $scope.hasMore=true;//是否还有更多数据加载
  $scope.dishList=[];//服务器加载数据
  $http.get('data/dish_listbypage.php?start=0').
  success(function(data){
    $scope.dishList = $scope.dishList.concat(data);
  });
  $scope.loadMore=function(){
    $http.get('data/dish_listbypage.php?start='+$scope.dishList.length).
    success(function(data){//服务器返回的数据少于五条 说明没有数据了
      if(data.length<5){
        $scope.hasMore=false;
      }
      $scope.dishList=$scope.dishList.concat(data);
    });
  };
  $scope.$watch('kw',function(){
    if($scope.kw){
      $http.get('data/dish_listbykw.php?kw='+$scope.kw).
      success(function(data){
        console.log(data)
        $scope.dishList=data;
      })
    }
  })
}).
  controller('detailCtrl',function($scope,$http,$routeParams){
  $scope.dishList=[];
  //console.log($routeParams.did);
  $http.get('data/dish_listbydid.php?did='+$routeParams.did).
  success(function(data){
    //console.log(data);
    $scope.dishList=data;
  })
}).
  controller('orderCtrl',function($rootScope,$scope,$routeParams,$http){
  //$routeParams.did
  $scope.order={};
  $scope.order.did=$routeParams.did;
  $scope.order.phone='13516501404';
  $scope.order.username='庞康荣';
  $scope.order.sex='1';
  $scope.order.addr='广州市番禺区108号';
  $scope.submitOrder=function(){
    //把数据转化为请求参数格式————k=v&k=v....;
    //提交订单之前把电话号码保存在全局中
    $rootScope.phone=$scope.order.phone;
    var str=$.param($scope.order);
    //console.log(str);
    //$http.get('data/order_add.php?'+str).success(function(data){
    //  $scope.result=data[0];
    //});
    $http.post('data/order_add.php',str).success(function(data){
      //console.log(data);
      $scope.result=data[0];
    })
  }
}).controller('myorderCtrl',function($scope){

}).controller('myorder1Ctrl',function($scope,$routeParams,$http){
  //$routeParams.phone
  $scope.orderList=[];
  $http.get('data/order_listbyphone.php?phone='+$routeParams.phone).
  success(function(data){
    $scope.orderList=data;
    //console.log(data);
  })
}).
   config(function($routeProvider){
  $routeProvider.
    when('/start',{
    templateUrl:'tpl/start.html',
    controller:'startCtrl'
  }).when('/mainn',{
    templateUrl:'tpl/mainn.html',
    controller:'mainnCtrl'

  }).when('/detail/:did',{
    templateUrl:'tpl/detail.html',
    controller:'detailCtrl'
  }).when('/order/:did',{
    templateUrl:'tpl/order.html',
    controller:'orderCtrl'
  }).when('/myorder',{
    templateUrl:'tpl/myorder.html',
    controller:'myorderCtrl'
  }).when('/myorder1/:phone',{
    templateUrl:'tpl/myorder1.html',
    controller:'myorder1Ctrl'
  }).
    otherwise({
    redirectTo:'/start'
  })
}).
run(function($http){
  //设置$http.post请求的默认请求信息
  $http.defaults.headers.post={
    'Content-Type':'application/x-www-form-urlencoded'
  }
});