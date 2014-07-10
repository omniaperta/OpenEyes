<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2014
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2014, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class PatientSummaryPopup extends BaseCWidget
{

	public $patient;
	public $accessLevel;

	public static $LIST_SEPARATOR = ',<br/>';

	protected $warnings;
	protected $ophthalmicDiagnoses;
	protected $systemicDiagnoses;
	protected $cviStatus;
	protected $medications;
	protected $allergies;

	public function init()
	{
		// NOTE: we should be registering the widget package here, but as we don't
		// have core assets defined as a clientside package, we have to manually publish
		// the widget script to ensure the script tag is output below the core scripts.
		// (This is done in BaseCWidget);
		// Yii::app()->clientScript->registerPackage('patientSummaryPopup');

		$this->cviStatus = $this->patient->getOPHInfo()->cvi_status->name;
		$this->warnings = $this->patient->getWarnings($this->accessLevel);

		$this->ophthalmicDiagnoses = join(
			self::$LIST_SEPARATOR,
			$this->patient->ophthalmicDiagnosesSummary
		);

		$this->systemicDiagnoses = join(
			self::$LIST_SEPARATOR,
			$this->patient->systemicDiagnosesSummary
		);

		$this->medications = join(
			self::$LIST_SEPARATOR,
			$this->patient->medicationsSummary
		);

		$this->allergies = join(
			self::$LIST_SEPARATOR,
			$this->patient->allergiesSummary
		);

		parent::init();
	}
}