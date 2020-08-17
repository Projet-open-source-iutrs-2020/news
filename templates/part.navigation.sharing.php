<li class="add-new">
    <div class="heading">
        <button
            class="icon-add"
            data-apps-slide-toggle="#new-sharing"
            news-focus="[name='textBoxSharingT']"><?php p($l->t('Share'))?></button>
    </div>

    <div class="add-new-popup" id="new-sharing" news-share="Navigation.shareData" ng-controller="SettingsController as Settings">

        <form ng-submit=""
              name="sharingform">
              <fieldset ng-disabled="Navigation.addingShare">
                    <!-- Tag selection -->
                    <div>
                       <label>Sélectionnez les tags à ajouter (optionnel) :</label>
                       <select ng-model="Selected">   
                            <option ng-repeat="tag in Settings.tags"
                                    ng-value="tag">{{tag}}
                                    
                            </option>
                       </select>
                       <button type="button" 
                            ng-click="Settings.addSelected(Selected, Navigation.shareData.textSharing)"
                            >Ajouter le tag</button>
                       <ul>
                            <li ng-repeat="tag in Settings.selected">
                                <p>◾{{ tag }} 
                                <button type="button" 
                                    ng-click="Settings.removeSelected(tag,Navigation.shareData.textSharing)"
                                    ng-style="{position: 'relative',left: '100px', top: 'auto'}">Retirer</button></p>
                            </li>
                            
                       </ul>
                       <button type="button" 
                            ng-click="Settings.clearSelected(Navigation.shareData.textSharing)" 
                            ng-if="Settings.selected.length != 0"> Reset</button>
                    </div>
                    
                    <br>

                    <!-- Text sharing -->
                    <label> Sélection de l'extrait à partager :</label> 
                    <br>
                    
                    <textarea type="text" 
                        name="textBoxSharing" 
                        ng-model="[Navigation.shareData.textSharing]" 
                        ng-style="{width: '100%', height: '200px'}"
                        autofocus></textarea>
                    <br>

                    <!-- Error manager -->
                    <p ng-style="{color: 'red'}">{{ Navigation.shareData.errorMessage }}<p>
                    <br>

                    <a class="twitter-share-button"
                        ng-href="https://twitter.com/intent/tweet?text={{ Navigation.shareData.textSharing }}&hashtags={{ Settings.selected.toString() }}">
                        Tweet</a>
                </fieldset>
        </form>
    </div>
</li>

