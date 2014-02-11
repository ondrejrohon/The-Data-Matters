  <div id="outer-wrapper" class="clearfix">
  	<div id="wrapper">
    
			<header>
				<?php if ($site_name): ?><h1 class='logo'><?php print $site_name ?></h1><?php endif; ?>
				<nav class="main-nav">
					<ul class="clearfix">
						<li class="menu-icon visible-xs"><a href="">Menu icon</a></li>
						<li class="filter-button menu-tablet hidden-xs">
							<a class="label active" href="">Projects</a>
							<div class="filter-content">
								<ul class="clearfix">
									<li><a href="">Interactive Map</a></li>
									<li><a class="active" href="">Projects</a></li>
									<li><a href="">About</a></li>
									<li><a href="">Organizations</a></li>
								</ul>
							</div>
						</li>
						<li class="filter-button">
							<a class="label" href="">Field</a>
							<div class="filter-content">
								<h3>Field <a href="" class="close">Close</a></h3>
								<ul class="clearfix">
									<?php foreach($field as $value):?>
									<li><a href=""><?=$value->name?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</li>
						<li class="filter-button">
							<a class="label" href="">Country</a>
							<div class="filter-content">
								<h3>Country <a href="" class="close">Close</a></h3>
								<ul class="clearfix">
									<?php foreach($countries as $value):?>
									<li><a href=""><?=$value->name?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</li>
						<li class="menu-search hidden-xs clearfix">
							<input type="text" placeholder="Search">
							<a href="" class="submit">Search</a>
						</li>
					</ul>
					<a href="" class="close-full-preview">Close</a>
				</nav>
			</header>
			<div class="main-content">
				<?php if ($primary_local_tasks): ?><ul class='links clearfix'><?php print render($primary_local_tasks) ?></ul><?php endif; ?>
			    <?php if ($secondary_local_tasks): ?><ul class='links clearfix'><?php print render($secondary_local_tasks) ?></ul><?php endif; ?>
		    
				<?php print render($page['content']);?>
			</div>

  	</div>
  </div>


<?php if ($page['help'] || ($show_messages && $messages)): ?>
  <div id='console'><div class='limiter clearfix'>
    <?php print render($page['help']); ?>
    <?php if ($show_messages && $messages): print $messages; endif; ?>
  </div></div>
<?php endif; ?>
