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

use OCP\AppFramework\Db\Entity;

class Sharing extends Entity implements IAPI, \JsonSerializable
{
    use EntityJSONSerializer;

    /** @var string */
    protected $shareTag = '';
    /** @var string|null */
    protected $lastModified = '0';    

    /**
     * @return null|string
     */
    public function getShareTag()
    {
        return $this->shareTag;
    }

    /**
     * @return string|null
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return null
     */
    public function setTag($value)
    {
        if ($this->shareTag !== $value){
            $this->shareTag = $value;
            $this->markFieldUpdated('tag');
        }     
    }

    /**
     * @param string|null $lastModified
     */
    public function setLastModified(string $lastModified = null)
    {
        if ($this->lastModified !== $lastModified) {
            $this->lastModified = $lastModified;
            $this->markFieldUpdated('lastModified');
        }
    }

    public function jsonSerialize(): array
    {
        return
            [
                'id' => $this->id,
                'tag' => $this->shareTag
            ];
    }

    public function toAPI(): array
    {
        return [
            'id' => $this->id,
            'tag' => $this->shareTag
        ];
    }
}