<?php echo '<?php '; ?>

class m<?php if (isset($migrationid)) { echo $migrationid; } ?>_event_type_<?php echo $this->moduleID; ?> extends CDbMigration
{
	public function up()
	{
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'<?php echo $this->moduleSuffix; ?>'))->queryRow();

<?php
			if (isset($elements)) {
				foreach ($elements as $element) {
					if ($element['mode'] == 'create') {
?>
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'<?php echo $element['name'];?>',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => '<?php echo $element['name'];?>','class_name' => '<?php echo $element['class_name'];?>', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
<?php
					}
?>
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'<?php echo $element['name'];?>'))->queryRow();
<?php
				}
			}
?>

<?php
		if (isset($elements)) {
			foreach ($elements as $element) {
				foreach ($element['lookup_tables'] as $lookup_table) {?>
		$this->createTable('<?php echo $lookup_table['name']?>', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
<?php if (isset($lookup_table['defaults'])) {?>
				'default' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
<?php }?>
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `<?php echo $lookup_table['lmui_key']?>` (`last_modified_user_id`)',
				'KEY `<?php echo $lookup_table['cui_key']?>` (`created_user_id`)',
				'CONSTRAINT `<?php echo $lookup_table['lmui_key']?>` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `<?php echo $lookup_table['cui_key']?>` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

<?php foreach ($lookup_table['values'] as $i => $value) {?>
		$this->insert('<?php echo $lookup_table['name']?>',array('name'=>'<?php echo str_replace("'","\\'",$value)?>','display_order'=><?php echo ($i+1)?><?php if (isset($lookup_table['defaults']) && in_array(($i+1),$lookup_table['defaults'])) {?>,'default' => 1<?php }?>));
<?php }?>

<?php }?>

<?php foreach ($element['defaults_tables'] as $default_table) {?>
		$this->createTable('<?php echo $default_table['name']?>', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `<?php echo $default_table['lmui_key']?>` (`last_modified_user_id`)',
				'KEY `<?php echo $default_table['cui_key']?>` (`created_user_id`)',
				'CONSTRAINT `<?php echo $default_table['lmui_key']?>` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `<?php echo $default_table['cui_key']?>` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

<?php foreach ($default_table['values'] as $value) {?>
		$this->insert('<?php echo $default_table['name']?>',array('value_id'=><?php echo $value?>));
<?php }?>
<?php }?>

<?php
				if ($element['mode'] == 'create') {?>
		$this->createTable('<?php echo $element['table_name'];?>', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
<?php
					$number = $element['number']; $count = 1;
					foreach ($element['fields'] as $field => $value) {
						$field_name = $value['name'];
						$field_label = $value['label'];
						$field_type = $this->getDBFieldSQLType($value);
						if ($field_type) {?>
				'<?php echo $field_name?>' => '<?php echo $field_type?>',

<?php }
						if (isset($field['extra_report'])) {?>
				'<?php echo $field_name?>2' => '<?php echo $field_type?>',

<?php }
						$count++;
					}
				?>
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `<?php echo $element['lmui_key']?>` (`last_modified_user_id`)',
				'KEY `<?php echo $element['cui_key']?>` (`created_user_id`)',
				'KEY `<?php echo $element['ev_key']?>` (`event_id`)',
<?php foreach ($element['foreign_keys'] as $foreign_key) {?>
				'KEY `<?php echo $foreign_key['name']?>` (`<?php echo $foreign_key['field']?>`)',
<?php }?>
				'CONSTRAINT `<?php echo $element['lmui_key']?>` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `<?php echo $element['cui_key']?>` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `<?php echo $element['ev_key']?>` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
<?php foreach ($element['foreign_keys'] as $foreign_key) {?>
				'CONSTRAINT `<?php echo $foreign_key['name']?>` FOREIGN KEY (`<?php echo $foreign_key['field']?>`) REFERENCES `<?php echo $foreign_key['table']?>` (`id`)',
<?php }?>
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

<?php } else {?>
<?php
						$number = $element['number']; $count = 1;
						foreach ($element['fields'] as $field => $value) {
							$field_name = $element['fields'][$count]['name'];
							$field_type = $this->getDBFieldSQLType($element['fields'][$count]);
							if ($field_type) {
?>
		$this->addColumn('<?php echo $element['table_name']?>','<?php echo $field_name?>','<?php echo $field_type?>');

<?php }
if (isset($field['extra_report'])) {?>
		$this->addColumn('<?php echo $element['table_name']?>','<?php echo $field_name?>2','<?php echo $field_type?>');

<?php }
							foreach ($element['foreign_keys'] as $foreign_key) {
								if ($foreign_key['field'] == $field_name) {?>
		$this->createIndex('<?php echo $foreign_key['name']?>','<?php echo $element['table_name']?>','<?php echo $field_name?>');

		$this->addForeignKey('<?php echo $foreign_key['name']?>','<?php echo $element['table_name']?>','<?php echo $field_name?>','<?php echo $foreign_key['table']?>','id');

<?php }
							}
							$count++;
						}
?>
<?php }?>

<?php foreach ($element['mapping_tables'] as $mapping_table) {?>
		$this->createTable('<?php echo $mapping_table['name'];?>', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'<?php echo $mapping_table['lookup_table']?>_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `<?php echo $mapping_table['lmui_key']?>` (`last_modified_user_id`)',
				'KEY `<?php echo $mapping_table['cui_key']?>` (`created_user_id`)',
				'KEY `<?php echo $mapping_table['ele_key']?>` (`element_id`)',
				'KEY `<?php echo $mapping_table['lku_key']?>` (`<?php echo $mapping_table['lookup_table']?>_id`)',
				'CONSTRAINT `<?php echo $mapping_table['lmui_key']?>` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `<?php echo $mapping_table['cui_key']?>` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `<?php echo $mapping_table['ele_key']?>` FOREIGN KEY (`element_id`) REFERENCES `<?php echo $element['table_name']?>` (`id`)',
				'CONSTRAINT `<?php echo $mapping_table['lku_key']?>` FOREIGN KEY (`<?php echo $mapping_table['lookup_table']?>_id`) REFERENCES `<?php echo $mapping_table['lookup_table']?>` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

<?php }?>
<?php } ?>
<?php } ?>
	}

	public function down()
	{
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'<?php echo $this->moduleSuffix; ?>'))->queryRow();

<?php
		if (isset($elements)) {
			foreach ($elements as $element) {
				foreach ($element['mapping_tables'] as $mapping_table) {?>
		$this->dropTable('<?php echo $mapping_table['name']?>');
<?php }
if ($element['mode'] == 'create') {?>
		$this->dropTable('<?php echo $element['table_name']; ?>');
<?php } else {?>
<?php
					$number = $element['number']; $count = 1;
					foreach ($element['fields'] as $field => $value) {
						$field_name = $element['fields'][$count]['name'];
						$field_type = $this->getDBFieldSQLType($element['fields'][$count]);
						if ($field_type) {
							foreach ($element['foreign_keys'] as $foreign_key) {
								if ($foreign_key['field'] == $field_name) {?>
		$this->dropForeignKey('<?php echo $foreign_key['name']?>','<?php echo $element['table_name']?>');

		$this->dropIndex('<?php echo $foreign_key['name']?>','<?php echo $element['table_name']?>');

<?php }
							}
?>
		$this->dropColumn('<?php echo $element['table_name']?>','<?php echo $field_name?>');

<?php }
						if (isset($field['extra_report'])) {?>
		$this->dropColumn('<?php echo $element['table_name']?>','<?php echo $field_name?>2');

<?php }
						$count++;
					}
?>
<?php }?>

<?php foreach ($element['defaults_tables'] as $defaults_table) {?>
		$this->dropTable('<?php echo $defaults_table['name']?>');
<?php }?>

<?php foreach ($element['lookup_tables'] as $lookup_table) {?>
		$this->dropTable('<?php echo $lookup_table['name']?>');
<?php }?>

<?php if ($element['mode'] == 'create') {?>
		$this->delete('element_type','event_type_id='.$event_type['id']." and class_name = '<?php echo $element['class_name']?>'");
<?php }?>

<?php }} ?>
	}
}

