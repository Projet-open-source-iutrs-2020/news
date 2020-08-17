<div id="sharingSettings">
    
    <div class="form-line" ng-controller="SettingsController as Settings" ng-init="Settings.initializeTags()">
        <p>Tag configuration :</p>
        <br>
        <label> Ajouter un tag : </label>
        <input type="text"></input>
        <button ng-click="Settings.createTag(tagValue)" ng-init="tagValue = ''" ng-model="{{ tagValue }}">Ajouter le tag</button>
        {{tagValue}}
        <ul>
            <li ng-repeat="tag in Settings.tags">
                {{ tag }} 
                <input ng-value="tag"></input>
                <button ng-click="Settings.updateTag(tag)">Modifier</button>
                <button ng-click="Settings.deleteTag(tag)">Supprimer</button>
            </li>
        </ul>
    </div>
</div>