<?php
/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author    Alessandro Cosentino <cosenal@gmail.com>
 * @author    Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright 2012 Alessandro Cosentino
 * @copyright 2012-2014 Bernhard Posselt
 */

namespace OCA\News\Db;

use OCA\News\Utility\Time;
use OCP\IDbConnection;
use OCP\AppFramework\Db\Entity;

class SharingMapper extends NewsMapper {

    public function __construct(IDbConnection $db,  Time $time) {
        parent::__construct($db, 'news_sharing', Sharing::class, $time);
    }

    public function find($id, $userId) {
        $sql = 'SELECT * ' .
                'FROM `*PREFIX*news_sharing`' .
                'WHERE `id` = ?';
        $params = [$id];
        
        return $this->findEntities($sql,$params);
    }

    public function findAll() {
        $sql = 'SELECT * ' .
                'FROM `*PREFIX*news_sharing`';
        return $this->findEntities($sql, []);
    }
}