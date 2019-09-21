<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$user = JFactory::getUser();
$this->language = $doc->language;
$this->direction = $doc->direction;


// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
$wa   = $this->getWebAssetManager();

if ($task == "edit" || $layout == "form") {
    $fullWidth = 1;
} else {
    $fullWidth = 0;
}
$wa->usePreset('template.bootstrap5.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'));
HTMLHelper::_('bootstrap.framework', true);

// Adjusting content width
if ($this->countModules('sidebar-left') && $this->countModules('position-7')) {
    $span = "col-md-6";
} elseif ($this->countModules('sidebar-left') && !$this->countModules('position-7')) {
    $span = "col-md-9";
} elseif (!$this->countModules('sidebar-left') && $this->countModules('position-7')) {
    $span = "col-md-9";
} else {
    $span = "col-md-12";
}

$nbspan2 = 0;
// Adjusting content width
if ($this->countModules('position-4'))
{
	$nbspan2 = 1;	
}
if ($this->countModules('position-5'))
{
	$nbspan2 = $nbspan2 + 1;
}
if ($this->countModules('position-6'))
{
	$nbspan2 = $nbspan2 + 1;
}
if ($nbspan2 == 0)
	$nbspan2 = 1;
$span2 = "col-lg-" . (12 / $nbspan2);

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <jdoc:include type="head" />
        <?php if($this->params->get('favicon')) { ?>
            <link rel="shortcut icon" href="<?php echo JUri::root(true) . htmlspecialchars($this->params->get('favicon'), ENT_COMPAT, 'UTF-8'); ?>" />
        <?php } ?>
        <!--[if lt IE 9]>
                <script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
        <![endif]-->

    </head>
	<body class="site">
		<div class="container">
			<div class="row navbar navbar-expand-lg navbar-light bg-faded">
				<button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="header row">
				<div class="col-md-10">
					<a class="navbar-brand pull-left" href="<?php echo JURI::base(); ?>"><?php echo $logo; ?></a>
				</div>
				<div class="col-md-1">
					<jdoc:include type="modules" name="head" style="none" />
				</div>			
				<div class="col-md-1">			
				</div>
			</div>
		<div class="navbar navbar-expand-lg navbar-light bg-light navbar-collapse collapse" id="navbarSupportedContent" style="position:relative">
				<jdoc:include type="modules" name="navbar-1" style="none" />
				<jdoc:include type="modules" name="navbar-2" style="none" />
			</div>
			<!--<div class="jumbotron jumbotron-fluid bg-primary text-white">
				<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
					<?php if(JURI::base() == JURI::current()) { ?>
						<h1><?php echo $app->get('sitename'); ?></h1>
							<?php if ($this->params->get('sitedescription')) { ?>
								<p class="lead">
									<?php echo htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8'); ?>
								</p>
							<?php }?>
					<?php } else {?>
						<h1><?php echo $this->getTitle();; ?>
					<?php } ?>
				</div>
			</div>-->
			<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
				<jdoc:include type="modules" name="banner" style="xhtml" />
				<?php if ($this->countModules('breadcrumbs')) : ?>
					<div class="row">
						<div class="col-sm-12">
							<jdoc:include type="modules" name="breadcrumbs" style="xhtml" />
						</div>
					</div>
				<?php endif; ?>
				<div class="row">
					<?php if ($this->countModules('sidebar-left')) : ?>
						<div id="sidebar" class="col-md-3">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="sidebar-left" style="xhtml" />
							</div>
						</div>
					<?php endif; ?>
					<div id="content" role="main" class="<?php echo $span; ?>">
						<jdoc:include type="modules" name="position-3" style="xhtml" />
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="position-2" style="none" />
					</div>
					<?php if ($this->countModules('position-7')) : ?>
						<div id="aside" class="col-md-3">
							<jdoc:include type="modules" name="position-7" style="xhtml" />
						</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<?php if ($this->countModules('position-4')) : ?>
						<div id="sidebar" class="col-md-4">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="position-4" style="xhtml" />
							</div>
						</div>
					<?php endif; ?>
					<?php if ($this->countModules('position-5')) : ?>
						<div id="sidebar" class="<?php echo $span2; ?>">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="position-5" style="xhtml" />
							</div>
						</div>
					<?php endif; ?>
					<?php if ($this->countModules('position-6')) : ?>
						<div id="sidebar" class="col-md-4">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="position-6" style="xhtml" />
							</div>
						</div>
					<?php endif; ?>
				</div>
		<!--</div>-->
			<footer class="footer" role="contentinfo">
				<hr />
				<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
					<div class="row">
							<jdoc:include type="modules" name="footer" style="none" />
					</div>
				</div>
			</footer>
			<jdoc:include type="modules" name="debug" style="none" />
		</div>
	</body>
</html>
