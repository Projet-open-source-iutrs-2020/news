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
namespace OCA\News\Service;

use OCP\IConfig;
use \OCP\AppFramework\Db\DoesNotExistException;

use \OCA\News\Db\Sharing;
use OCA\News\Config\Config;
use \OCA\News\Db\SharingMapper;

class SharingService extends Service
{
    protected $mapper;
    private $config;
    private $systemConfig;

    public function __construct(SharingMapper $mapper, Config $config, IConfig $systemConfig
    ){
        parent::__construct($mapper);
        $this->config = $config;
        $this->mapper = $mapper;     
        $this->systemConfig = $systemConfig;   
    }

    /**
     * A function to find all of the tags
     */
    public function findAll() {
        return $this->mapper->findAll();
    }

    /**
     * A function to find the tag by using user id and id of tag (only for implement)
     * 
     * @param int $id Id of the tag
     * @param int $userId Id of the user
     */
    public function find($id, $userId) {
            return $this->mapper->findByTag($id);
    }

    /**
     * A function to create new tag
     * 
     * @param string $tag The value of the tag
     */
    public function create($tag) {
        $sharing = new Sharing();
        $sharing->setTag($tag);
        return $this->mapper->insert($sharing);
    }

    /**
     * A function to update a tag
     * 
     * @param string $tag The tag to change value
     * @param string $value The new value of tag
     */
    public function update(string $tag, string $value) {
        $sharing = $this->mapper->findByTag($tag);
        $sharing->setTag($value);
        return $this->mapper->update($sharing);
    }

    /**
     * A function to delete a tag
     * 
     * @param string $tag The tag to delete
     */
    public function delete(string $tag){
        $sharing = $this->mapper->findByTag($tag);
        $this->mapper->delete($sharing);
    }
}