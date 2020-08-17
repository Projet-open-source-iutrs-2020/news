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

namespace OCA\News\Controller;

use \OCP\IRequest;
use \OCP\IConfig;
use \OCP\AppFramework\Controller;
use \OCP\AppFramework\Http;

use \OCA\News\Service\ServiceException;
use \OCA\News\Service\ServiceNotFoundException;
use \OCA\News\Service\ServiceConflictException;
use \OCA\News\Service\ServiceValidationException;
use \OCA\News\Service\SharingService;


class SharingController extends Controller
{
    use JSONHttpError;
    private $service;
    private $settings;

    public function __construct(string $appName, IRequest $request, SharingService $service,IConfig $settings) {
        parent::__construct($appName, $request);
        $this->service = $service;
        $this->settings = $settings;
    }

    /**
     * A function to get all tags
     * 
     * @NoAdminRequired
     */
    public function index() {
        $sharings = $this->service->findAll();
        return ['sharing' => $sharings];
    }

    /**
     * A function to show on tag (Any uses, but maybe for future ..)
     * 
     * @NoAdminRequired
     *
     * @param int $id The id of the tag
     */
    public function show(int $id) 
    {
        try {
            $this->service->find($id);
        } catch (ServiceNotFoundException $ex) {
            return $this->error($ex, Http::STATUS_NOT_FOUND);
        }
        return [];
    }

    /**
     * A function to create new tag
     * 
     * @NoAdminRequired
     *
     * @param string $tag
     * @return array|\OCP\AppFramework\Http\JSONResponse
     */
    public function create($tag) {
        try
        {   
            $sharings = $this->service->create($tag, $this->userId);
            return ['sharings' => [$sharings]];
        } catch (ServiceConflictException $ex) {
            return $this->error($ex, Http::STATUS_CONFLICT);
        } catch (ServiceValidationException $ex) {
            return $this->error($ex, Http::STATUS_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * A function to update tag
     * 
     * @NoAdminRequired
     *
     * @param string $tag The tag that we want to change value
     * @param string $value The new tag value
     */
    public function update(string $tag, string $value) {
        try {
            $sharing = $this->service->update(
                $tag,
                $value
            );

            return ['sharings' => [$sharing]];
        } catch (ServiceConflictException $ex) {
            return $this->error($ex, Http::STATUS_CONFLICT);
        } catch (ServiceValidationException $ex) {
            return $this->error($ex, Http::STATUS_UNPROCESSABLE_ENTITY);
        } catch (ServiceNotFoundException $ex) {
            return $this->error($ex, Http::STATUS_NOT_FOUND);
        }
    }

    /**
     * A function to delete a tag
     * 
     * @NoAdminRequired
     *
     * @param string $tag The tag that we want to delete
     */
    public function destroy(string $tag) {
        try{
            $sharing = $this->service->delete(
                $tag
            );
            return ['sharing' => $sharing];
        }catch (ServiceConflictException $ex) {
            return $this->error($ex, Http::STATUS_CONFLICT);
        } catch (ServiceValidationException $ex) {
            return $this->error($ex, Http::STATUS_UNPROCESSABLE_ENTITY);
        } catch (ServiceNotFoundException $ex) {
            return $this->error($ex, Http::STATUS_NOT_FOUND);
        }
    }
}