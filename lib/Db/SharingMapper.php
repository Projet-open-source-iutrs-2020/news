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

    /**
     * A function to find user by id, only for implementation, no direct uses
     * 
     * @param int $id The id of tag
     * @param int $userId The user id of the user
     */
    public function find($id, $userId) {
        $sql = 'SELECT * ' .
                'FROM `*PREFIX*news_sharing`' .
                'WHERE `id` = ?';
        $params = [$id];
        
        return $this->findEntities($sql,$params);
    }

    /**
     * A function to get all tags
     */
    public function findAll() {
        $sql = 'SELECT * ' .
                'FROM `*PREFIX*news_sharing`';
        return $this->findEntities($sql, []);
    }

    /**
     * A function to search by tag
     * 
     * @param string $tag The tag
     */
    public function findByTag($tag)
    {
        $sql = 'SELECT * FROM `*PREFIX*news_sharing` ' .
            'WHERE `share_tag` = ? ';
        $params = [$tag];

        return $this->findEntities($sql, $params);
    }

    /**
     * A function to delete by tag
     * 
     * @param Entity $entity The entity to remove from DB
     */
    public function delete(Entity $entity)
    {
        parent::delete($entity);
        $sql = 'DELETE FROM `*PREFIX*news_sharing` WHERE `id` = ?';
        $params = [$entity->getId()];

        $stmt = $this->execute($sql, $params);
        $stmt->closeCursor();
    }
}