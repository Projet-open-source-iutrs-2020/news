/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Bernhard Posselt 2014
 */
app.factory('SharingRessource', function (Resource, $http, BASE_URL) {
    'use strict';

    var SharingRessource = function ($http, BASE_URL) {
        Resource.call(this, $http, BASE_URL);
    };

    SharingRessource.prototype = Object.create(Resource.prototype);

    //Used for creating new tags for twitter on the tag list
    SharingRessource.prototype.addTag = function (tag) {
        var url = this.BASE_URL + 
        '/sharing/create';

        return this.http({
            url: url,
            method: 'POST',
            data:{
                tag: tag
            }
        }).then(function (response) {
            return response.data;
        }, function (response) {
            console.log(response);
        });
    };

    //For getting all tag for twitter sharing
    SharingRessource.prototype.getAllTags = function () {
        var url = this.BASE_URL + 
        '/sharing/getTags';

        return this.http({
            url: url,
            method: 'GET'
        });
    };

    SharingRessource.prototype.getTag = function (tagId) {
        var url = this.BASE_URL + 
        '/sharing/getTag/' + tagId;

        return this.http({
            url: url,
            method: 'POST',
            data:{
                tagId: tagId
            }
        });
    };


    SharingRessource.prototype.updateTag = function (tagId, tag) {
        var url = this.BASE_URL + 
        '/sharing/update/' + tagId;

        return this.http({
            url: url,
            method: 'PUT',
            data:{
                sharingTag: tag,
                tagId: tagId
            }
        });
    };

    SharingRessource.prototype.deleteTag = function (tagId) {
        var url = this.BASE_URL + 
        '/sharing/delete/' + tagId;

        return this.http({
            url: url,
            method: 'DELETE',
            data:{
                tagId: tagId
            }
        });
    };

    return new SharingRessource($http, BASE_URL);
});