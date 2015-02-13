<?php

class m150213_201100_contact_other_names extends OEMigration
{
	public function safeUp()
	{
		$this->addColumn('contact', 'other_names', 'string');
		$this->addColumn('contact_version', 'other_names', 'string');
	}

	public function safeDown()
	{
		$this->dropColumn('contact_version', 'other_names');
		$this->dropColumn('contact', 'other_names');
	}
}
