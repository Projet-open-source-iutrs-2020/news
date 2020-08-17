/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Bernhard Posselt 2014
 */
app.directive('newsShare', function ($rootScope, $timeout) {
    'use strict';

    return {
        restrict: 'A',
        link: function (scope, elem) {
            $rootScope.$on('addShare', function (_, textSharing, errorSharing) {
                $timeout(function () {
                    if (elem.is(':animated')) {
                        elem.stop(true, true);
                        elem.show();
                    } else if (!elem.is(':visible')) {
                        elem.slideDown();
                    }
                    elem.find('[ng-model="Navigation.shareData.text"]').focus();
                });
                scope.Navigation.shareData.textSharing = textSharing;
                scope.Navigation.shareData.errorMessage = errorSharing;
            });
        }
    };
});