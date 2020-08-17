/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Bernhard Posselt 2014
 */

 /*
 * This service is not implemented yet
 */
app.factory('SharingRessource', function (Resource, $http, BASE_URL) {
    'use strict';

    var SharingRessource = function ($http, BASE_URL) {
        Resource.call(this, $http, BASE_URL);
    };

    SharingRessource.prototype = Object.create(Resource.prototype);

    /**
     * A function to create new tag
     * @param {*} tag The tag to create
     */
    SharingRessource.prototype.addTag = function (tag) {
        var url = this.BASE_URL + 
        '/sharing/create';

        return this.http({
            url: url,
            method: 'POST',
            data:{
                tag: tag.toString()
            }
        }).then(function (response) {
            return response.data;
        }, function (response) {
            console.log(response);
        });
    };

    /**
     * A function to get all tags
     */
    SharingRessource.prototype.getAllTags = function () {
        var url = this.BASE_URL + 
        '/sharing/getTags';

        return this.http({
            url: url,
            method: 'GET'
        });
    };

    /**
     * A function to update new tag
     * @param {*} tag The tag to update
     * @param {*} value The value of the tag
     */
    SharingRessource.prototype.updateTag = function (tag, value) {
        var url = this.BASE_URL + 
        '/sharing/update/' + tag;

        return this.http({
            url: url,
            method: 'PUT',
            data:{
                value: value,
                tag: tag
            }
        });
    };

    /**
     * A function to delete tag
     * @param {*} tag The tag to delete
     */
    SharingRessource.prototype.deleteTag = function (tag) {
        var url = this.BASE_URL + 
        '/sharing/delete/' + tag;

        return this.http({
            url: url,
            method: 'DELETE',
            data:{
                tag: tag
            }
        });
    };

    return new SharingRessource($http, BASE_URL);
});