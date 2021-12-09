<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$this->language  = $doc->language;
$this->direction = $doc->direction;
// Getting params from template
$params = $app->getTemplate(true)->params;

$header = JFactory::getApplication()->input->getInt('header', 0);

$wa   = $this->getWebAssetManager();
$ws = $doc->getWebAssetManager()->getRegistry();
$ws->addTemplateRegistryFile("bootstrap5", 0);
$wa->usePreset('template.bootstrap5.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'));
if (!isset($sitename)) {
	$sitename = "";
}
// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<jdoc:include type="head" />
<!--[if lt IE 9]>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
<![endif]-->
</head>
<body class="site">
		<div class="container">

	<?php if ($header) : ?>
	<header class="row navbar navbar-expand-lg navbar-light bg-faded" style="position:relative;">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="col-md-9">
			<a class="navbar-brand pull-left" href="<?php echo JURI::base(); ?>"><?php echo $logo; ?></a>
		</div>
		<div class="col-md-1">
			<jdoc:include type="modules" name="head" style="none" />
		</div>			
		<div class="col-md-2">
			
		</div>
		</div>
	</header>
	<?php endif ?>
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<jdoc:include type="message" />
			<jdoc:include type="component" />
		</div>
</body>
</html>
