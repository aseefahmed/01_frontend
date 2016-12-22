angular.module('myApp').filter('filterDate', function($filter){
    return function(text){
        text = ""+text+"";
        var  tempdate= new Date(text.replace(/-/g,"/"));
        return $filter('date')(tempdate, "dd/MMM/yyyy");
    }
});
