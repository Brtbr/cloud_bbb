<?php
	/** @var $_ array */
	/** @var $l \OCP\IL10N */
	style('core', 'guest');
?>

	<div class="update bbb">
		<h2><?php p($_['room']) ?></h2>
		<p><?php p($l->t('After the meeting ended, the room will get removed')); ?><br /></p>
		<p><a class="button primary" href="<?php p(\OCA::$JoinController->forwardToRoom()) ?>">
			<?php p($l->t('Join Room')); ?>
		</a></p>
		
	</div>
