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

/**
 * Response object for FhirClient
 */
class FhirResponse
{
	private $code;
	private $value;

	/**
	 * @param int $code
	 * @param StdClass $value
	 */
	public function __construct($code, $value = null)
	{
		$this->code = $code;
		$this->value = $value;
	}

	/**
	 * @return int
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @return StdClass|null
	 */
	public function getValue()
	{
		return $this->value;
	}
}
