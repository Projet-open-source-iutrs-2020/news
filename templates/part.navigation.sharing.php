<li class="add-new">
    <div class="heading">
        <button
            class="icon-add"
            data-apps-slide-toggle="#new-sharing"
            news-focus="[name='textBoxSharingT']"><?php p($l->t('Share'))?></button>
    </div>

    <div class="add-new-popup" id="new-sharing" news-share="Navigation.shareData">

        <form ng-submit=""
              name="sharingform">
              <fieldset ng-disabled="Navigation.addingShare">
                    <!-- Tag selection -->
                    <label>Sélectionnez les tags à ajouter (optionnel) :</label>
                    <select ng-options=""
                            ng-model=""></select>
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
                        ng-href="https://twitter.com/intent/tweet?text={{ Content.adaptTextTo(item.title)}}">
                        Tweet</a>
                </fieldset>
        </form>
    </div>
</li>
