<?php
	/** @var $_ array */
	/** @var $l \OCP\IL10N */
	style('core', 'guest');
?>

	<div class="update bbb">
		<h2><?php p($_['room']) ?></h2>
		<p><?php p($_['text']); ?><br />
			<br />
			<a href="<?php print_unescaped($_['url']); ?>"><?php p($l->t('Let\'s go!')); ?></a></p>
	</div>
