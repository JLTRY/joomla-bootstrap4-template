

function googlelog()
{
	jQuery('.mod-login input[name="option"]').val("com_jgoogle");
	jQuery('.mod-login').attr('action', '/index.php?option=com_jgoogle&task=user.login&XDEBUG_SESSION_START=test');
	Joomla.submitbutton('user.login');
	//Joomla.submitform('user.login');
}