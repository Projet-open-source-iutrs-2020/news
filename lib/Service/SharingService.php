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

    public function findAll() {
        return $this->mapper->findAll();
    }

    public function find($id, $userId) {
            return $this->mapper->find($id);
    }

    public function create($tag) {
        $sharing = new Sharing();
        $sharing->setTag($tag);
        return $this->mapper->insert($sharing);
    }

    public function update(int $id, string $tag) {
        $sharing = $this->mapper->find($id);
        $sharing->setTag($tag);
        return $this->mapper->update($sharing);

    }
}