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
    /** @var string */
    protected $userId = '';
    /** @var string|null */
    protected $lastModified = '0';    

    /**
     * A function to get the value of tag
     * @return null|string
     */
    public function getShareTag()
    {
        return $this->shareTag;
    }

    /**
     * A function to get last modified date
     * @return string|null
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * A function to set new tag
     * @return null
     */
    public function setTag(string $value)
    {
        if ($this->shareTag !== $value){
            $this->shareTag = $value;
            $this->markFieldUpdated('shareTag');
        }     
    }

    /**
     * A function to set the last modified date of tag
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
                'userId' => $this->userId,
                'shareTag' => $this->shareTag
            ];
    }

    public function toAPI(): array
    {
        return [
            'id' => $this->id,
            'shareTag' => $this->shareTag
        ];
    }

    /**
     * A function to get user id (traceability on logs)
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * A function to set user id
     * @param string $userId
     */
    public function setUserId(string $userId)
    {
        if ($this->userId !== $userId) {
            $this->userId = $userId;
            $this->markFieldUpdated('userId');
        }
    }
}