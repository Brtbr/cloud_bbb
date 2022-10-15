<?php

declare(strict_types=1);

namespace OCA\BigBlueButton\Search;

use OCA\BigBlueButton\AppInfo\Application;
use OCA\BigBlueButton\Service\RoomService;
use OCA\BigBlueButton\Db\Room;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\IUser;
use OCP\Search\IProvider;
use OCP\Search\ISearchQuery;
use OCP\Search\SearchResult;
use OCP\Search\SearchResultEntry;
use function array_map;

class Provider implements IProvider {
	/** @var RoomService */
	private $service;

	/** @var IL10N */
	private $l10n;

	/** @var IDateTimeFormatter */
	private $dateTimeFormatter;

	/** @var IURLGenerator */
	private $urlGenerator;

	public function __construct(RoomService $service,
								IL10N $l10n,
								IURLGenerator $urlGenerator) {
		$this->service = $service;
		$this->l10n = $l10n;
		$this->urlGenerator = $urlGenerator;
	}

	public function getId(): string {
		return Application::ID;
	}

	public function getName(): string {
		return 'BBB';
	}

	public function getOrder(string $route, array $routeParameters): int {
		if (strpos($route, Application::ID . '.') === 0) {
            return -1;
        }
		return Application::ORDER;
	}

	private function getAccess(string $access): string {
		switch ($access) {
			case 'public': 
				$translatedAccess = $this->l10n->t('Public');
				break;
			case 'password':
				$translatedAccess = $this->l10n->t('Internal + Password protection for guests');
				break;
			case 'waiting_room':
				$translatedAccess = $this->l10n->t('Internal + Waiting room for guests');
				break;
			case 'waiting_room_all':
				$translatedAccess = $this->l10n->t('Waiting room for all users');
				break;
			case 'internal':
				$translatedAccess = $this->l10n->t('Internal');
				break;
			case 'internal_restricted':
				$translatedAccess = $this->l10n->t('Internal restricted');
				break;
		}
		return $translatedAccess;
	}

    public function search(IUser $user, ISearchQuery $query): SearchResult {
		$cursor = $query->getCursor();
		$rooms = $this->service->search(
			$user,
			$query
		);

		$results = array_map(function(Room $room) {
			return [
				'object' => $room,
				'entry' => new SearchResultEntry(
					'',
					$room->getName(),
					$this->getAccess($room->getAccess()),
					$this->urlGenerator->linkToRoute('bbb.page.index'),
					$this->urlGenerator->imagePath('bbb', 'app-dark.svg')
				)
			];
		}, $rooms);

		$resultEntries = array_map(function(array $result) {
			return $result['entry'];
		}, $results);
        
        return SearchResult::complete(
			'BBB',
            $resultEntries
		);
	}	
}
