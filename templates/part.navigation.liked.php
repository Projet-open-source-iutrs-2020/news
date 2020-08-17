<li ng-class="{
        active: Navigation.isLikedActive(),
        unread: Navigation.isLikedUnread()
    }"
    class="with-counter liked-feed">

    <a class="icon-rss" ng-href="#/items/liked/" >
       <?php p($l->t('Liked articles'))?>
    </a>

    <div class="app-navigation-entry-utils">
        <ul>
            <li class="app-navigation-entry-utils-counter"
                ng-show="Navigation.isLikedUnread()"
                title="{{ Navigation.getLikedCountTotal() }}">
                {{ Navigation.getLikedCountTotal() | unreadCountFormatter }}
            </li>
        </ul>
    </div>
</li>