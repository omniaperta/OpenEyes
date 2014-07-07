<?php
/**
 * (C) OpenEyes Foundation, 2014
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (C) 2014, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

namespace services;

class PatientAllergiesService extends DeclarativeModelService
{
	static protected $operations = array(self::OP_READ, self::OP_UPDATE, self::OP_CREATE, self::OP_SEARCH);

	static protected $search_params = array(
		'id' => self::TYPE_TOKEN,
		'identifier' => self::TYPE_TOKEN,
		'family' => self::TYPE_STRING,
		'given' => self::TYPE_STRING,
	);

	static protected $primary_model = 'Patient';

	static public $model_map = array(
		'Patient' => array(
			'fields' => array(
				'allergies' => array(self::TYPE_LIST, 'allergyAssignments', 'PatientAllergy', 'PatientAllergyAssignment', array('patient_id' => 'primaryKey')),
				'no_allergies_date' => array(self::TYPE_SIMPLEOBJECT, 'no_allergies_date', 'Date'),
			),
		),
		'PatientAllergy' => array(
			'ar_class' => 'PatientAllergyAssignment',
			'reference_objects' => array(
				'allergy' => array('allergy_id', 'Allergy', array('name')),
			),
			'fields' => array(
				'name' => 'allergy.name',
			),
		),
	);

	public function search(array $params)
	{
	}
}