

function googlelog()
{
	jQuery('.mod-login input[name="option"]').val("com_jgoogle");
	jQuery('.mode-login').attr('action', '/index.php?option=com_jgoogle&task=user.login&XDEBUG_SESSION_START=test');
	Joomla.submitbutton('user.login');
	//Joomla.submitform('user.login');
}