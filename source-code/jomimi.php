<?php
/*****************************************************************
 * @package Madmimi - Joomla integration plugin
 * @version 1.0
 * @author http://www.shockwebstudio.com
 * 
 *****************************************************************/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');


class plgUserJomimi extends JPlugin
{
    /**
    	 * Example store user method
    	 *
    	 * @param	array		$user		Holds the new user data.
    	 * @param	boolean		$isnew		True if a new user is stored.
    	 * @param	boolean		$success	True if user was succesfully stored in the database.
    	 * @param	string		$msg		Message.
    	 *
    	 * @return	void
    	 * @since	1.6
    	 * @throws	Exception on error.
    	 */
        
    	public function onUserAfterSave($user, $isnew, $success, $msg)
    	{
    		
			$email          = $this->params->get('email');
			$apikey         = $this->params->get('apikey');
            $list         = $this->params->get('list');
			
			// Split the name for first name and last name based on space
            $name = explode(' ', $user['name']);
			
			
            // Include Madmimi API
            
            $mailer = new Madmimi($email,$apikey);

            $user = array(
				'email'=> ($user['email']),
				'firstName' => $name['0'],
				'lastName' => $name[1],
				'add_list' => $list
			);

            $mailer->AddUser($user);
    	}
}
