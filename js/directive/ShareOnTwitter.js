

app.directive('ShareOnTwitter', function ($rootScope, $timeout) {
    'use strict';

    return {
        restrict: 'A',
        link: function (scope, elem) {
            $rootScope.$on('ShareOnTwitter', function (events, args) {

                console.log(event);
            });
        }
    };
});