<?php

namespace OCA\BigBlueButton\Controller;

use OCA\BigBlueButton\Db\Room;
use OCA\BigBlueButton\Event\MeetingEndedEvent;
use OCA\BigBlueButton\Event\RecordingReadyEvent;
use OCA\BigBlueButton\Service\RoomService;
use OCP\AppFramework\Controller;
use OCP\EventDispatcher\IEventDispatcher;
use OCP\IRequest;

class HookController extends Controller {
	/** @var string */
	protected $token;

	/** @var Room|null */
	protected $room;

	/** @var RoomService */
	private $service;

	/** @var IEventDispatcher */
	private $eventDispatcher;

	/** @var IActivityManager */
	private $activityManager;

	public function __construct(
		string $appName,
		IRequest $request,
		RoomService $service,
		IEventDispatcher $eventDispatcher
	) {
		parent::__construct($appName, $request);

		$this->service = $service;
		$this->eventDispatcher = $eventDispatcher;
	}

	public function setToken(string $token): void {
		$this->token = $token;
		$this->room = null;
	}

	public function isValidToken(): bool {
		$room = $this->getRoom();

		return $room !== null;
	}

	/**
	 * @PublicPage
	 *
	 * @NoCSRFRequired
	 *
	 * @return void
	 */
	public function meetingEnded($recordingmarks = false): void {
		$recordingmarks = \boolval($recordingmarks);

		$room = $this->getRoom();
		$this->eventDispatcher->dispatch(MeetingEndedEvent::class, new MeetingEndedEvent($room, $recordingmarks));

		
		if($room->getRoomType() === ROOM::ROOMLIFE_SINGLE_USE) {
			$this->service->delete($room->getId());
		}

	}

	/**
	 * @PublicPage
	 *
	 * @NoCSRFRequired
	 *
	 * @return void
	 */
	public function recordingReady(): void {
		$this->eventDispatcher->dispatch(RecordingReadyEvent::class, new RecordingReadyEvent($this->getRoom()));
	}

	private function getRoom(): ?Room {
		if ($this->room === null) {
			$this->room = $this->service->findByUid($this->token);
		}

		return $this->room;
	}
}
