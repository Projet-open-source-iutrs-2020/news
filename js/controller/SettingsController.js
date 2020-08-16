/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Bernhard Posselt 2014
 */
app.controller('SettingsController', function ($route, $q, SettingsResource, ItemResource, OPMLParser, OPMLImporter,
                                               Publisher, SharingRessource,$rootScope) {
    'use strict';
    this.isOPMLImporting = false;
    this.isArticlesImporting = false;
    this.opmlImportError = false;
    this.articleImportError = false;
    this.opmlImportEmptyError = false;
    this.selected = [];
    this.tags = ['truc','bidule','chouette'];
    var self = this;

    var set = function (key, value) {
        SettingsResource.set(key, value);

        if (['showAll', 'oldestFirst', 'compact'].indexOf(key) >= 0) {
            $route.reload();
        }
    };

    this.toggleSetting = function (key) {
        set(key, !this.getSetting(key));
    };

    this.getSetting = function (key) {
        return SettingsResource.get(key);
    };

    this.importOPML = function (fileContent) {
        self.opmlImportError = false;
        self.opmlImportEmptyError = false;
        self.articleImportError = false;

        try {
            this.isOPMLImporting = false;
            var parsedContent = OPMLParser.parse(fileContent);

            var jobSize = 5;

            if (parsedContent.folders.length === 0 &&
                parsedContent.feeds.length === 0) {
                self.opmlImportEmptyError = true;
            } else {
                OPMLImporter.importFolders(parsedContent).then(function (feedQueue) {
                    return OPMLImporter.importFeedQueue(feedQueue, jobSize);
                }).finally(function () {
                    self.isOPMLImporting = false;
                });
            }

        } catch (error) {
            this.opmlImportError = true;
            console.error(error);
            this.isOPMLImporting = false;
        }
    };

    this.importArticles = function (content) {
        this.opmlImportError = false;
        this.articleImportError = false;

        try {
            this.isArticlesImporting = true;
            var articles = JSON.parse(content);

            var self = this;
            ItemResource.importArticles(articles).then(function (data) {
                Publisher.publishAll(data);
            }).finally(function () {
                self.isArticlesImporting = false;
            });

        } catch (error) {
            console.error(error);
            this.articleImportError = true;
            this.isArticlesImporting = false;
        }
    };

    /**
     * A function to get all tags (not implemented yet)
     */
    this.getAllTags = function () {
        return SharingRessource.getAllTags();
    };

    /**
     * A function to initialize the taglist (not implemented yet)
     */
    this.initializeTags = function (){
        this.tags = SharingRessource.getAllTags();
    };

    /**
     * A function to create a new tag (not implemented yet)
     * @param {*} tag The value of the tag
     */
    this.createTag = function (tag) {
        if(this.tags.find(tag)){
            SharingRessource.addTag(tag);
        }
    };

    /**
     * A function to update the value of a tag
     * @param {*} tag The tag that we want to change the value
     * @param {*} value The value of the tag
     */
    this.updateTag = function (tag, value){
        if(this.tags.find(tag)){
            SharingRessource.updateTag(tag, value);
        }
    };

    /**
     * A function to delete a tag
     * @param {*} tag The value of the tag
     */
    this.deleteTag = function (tag){
        if(this.tags.find(tag)){
            SharingRessource.deleteTag(tag);
        }
    };

    /**
     * A function to add tag to selection list
     * @param {*} value The tag wich we'll add
     * @param {*} text Actual extrait of sharing
     */
    this.addSelected = function (value, text){
        var err = '';
        if(text === undefined){
            text = '';
        }
        if(!this.selected.includes(value) && value !== ''){
            //Size tweet handling
            var tags = [...this.selected,value];
            if((text.length + tags.join().length) > 254){
                text = text.substring(0,(text.length - tags.toString().length)-3) + '...';
                err = `Attention, avec l'ajout de tag, votre extrait était trop long pour un tweet !`;
            }
            this.selected.push(value);
        }
        $rootScope.$broadcast('addShare',text, err);
    };

    /**
     * A function to delete a tag from the taglist
     * @param {*} value The tag wich we'll add
     * @param {*} text Actual extrait of sharing
     */
    this.removeSelected = function (value, text){
        $rootScope.$broadcast('addShare',text);
        this.selected.splice(this.selected.indexOf(value),1);
    };

    /**
     * A function to clear the taglist
     * @param {*} text Actual extrait of sharing
     */
    this.clearSelected = function (text){
        $rootScope.$broadcast('addShare',text);
        this.selected = [];
    };
});
