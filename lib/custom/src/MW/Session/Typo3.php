<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2011
 * @license LGPLv3, http://www.gnu.org/licenses/lgpl.html
 * @package MW
 * @subpackage Session
 * @version $Id: Typo3.php 16606 2012-10-19 12:50:23Z nsendetzky $
 */


/**
 * Managing session data using the TYPO3 session
 *
 * @package MW
 * @subpackage Session
 */
class MW_Session_Typo3 implements MW_Session_Interface
{
	private $_feuser = null;


	/**
	 * Initializes the Typo3 session object.
	 *
	 * @param tslib_feUserAuth Typo3 frontend user object from $GLOBALS['TSFE']->fe_user
	 */
	public function __construct( tslib_feUserAuth $feuser )
	{
		$this->_feuser = $feuser;
	}


	/**
	 * Returns the value of the requested session key.
	 *
	 * If the returned value wasn't a string, it's decoded from its serialized
	 * representation.
	 *
	 * @param string $name Key of the requested value in the session
	 * @param mixed $default Value returned if requested key isn't found
	 * @return mixed Value associated to the requested key
	 */
	public function get( $name, $default = null )
	{
		if( ( $value = $this->_feuser->getKey('ses', $name) ) !== null ) {
			return $value;
		}

		return $default;
	}


	/**
	 * Sets the value for the specified key.
	 *
	 * If the value isn't a string, it's encoded into a serialized representation
	 * and decoded again when using the get() method.
	 *
	 * @param string $name Key to the value which should be stored in the session
	 * @param mixed $value Value that should be associated with the given key
	 * @return void
	 */
	public function set( $name, $value )
	{
		$this->_feuser->setKey( 'ses', $name, $value );
	}
}
