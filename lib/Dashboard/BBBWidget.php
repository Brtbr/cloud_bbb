<?php

namespace OCA\BigBlueButton\Dashboard;

use OCP\Dashboard\IWidget;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\Util;

use OCA\BigBlueButton\AppInfo\Application;

class BBBWidget implements IWidget {

    /** @var IL10N */
    private $l10n;

    /** @var IURLGenerator */
    private $urlGenerator;

    public function __construct(IL10N $l10n, IURLGenerator $urlGenerator) {
        $this->l10n = $l10n;
        $this->urlGenerator = $urlGenerator;
    }

    /** @inheritDoc */
    public function getId(): string {
        return 'bbb';
    }

    /** @inheritDoc */
    public function getTitle(): string {
        return 'BBB';
    }

    /** @inheritDoc */
    public function getOrder(): int {
        return 80;
    }

    /** @inheritDoc */
    public function getIconClass(): string {
        return 'icon-mail';
    }

    /** @inheritDoc */
    public function getUrl(): ?string {
        return $this->urlGenerator->linkToRouteAbsolute('bbb.page.index');
    }

    /** @inheritDoc */
    public function load(): void {
        Util::addScript(Application::ID, Application::ID . '-dashboard');
	    Util::addStyle(Application::ID, 'dashboard');
    }

}