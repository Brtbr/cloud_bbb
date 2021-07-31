<?php

declare(strict_types=1);

namespace OCA\BigBlueButton\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version000000Date20210730150741 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		$schema = $schemaClosure();

		if ($schema->hasTable('bbb_rooms')) {
			$table = $schema->getTable('bbb_rooms');

			if($table-> hasColumn('room_type')) {
				$table->dropColumn('room_type');
			}

			if (!$table->hasColumn('room_life')) {
				$table->addColumn('room_life', 'string', [
					'notnull' => false,
					'length' => 64,
					'default' => 'persistant'
				]);
			}
		
			return $schema;
		}

		return null;
	}
}
