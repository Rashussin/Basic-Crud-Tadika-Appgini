<?php if(!$_GET['Embedded']){ ?>
	<div id="theme-form" class="hidden">
		<div class="form-group">
			<label for="demo-theme" class="control-label">Theme</label>
			<select id="demo-theme" class="form-control">
				<option value="bootstrap.css" selected>Bootstrap</option>
				<option value="cerulean.css">Cerulean</option>
				<option value="cosmo.css">Cosmo</option>
				<option value="cyborg.css">Cyborg</option>
				<option value="darkly.css">Darkly</option>
				<option value="flatly.css">Flatly</option>
				<option value="journal.css">Journal</option>
				<option value="paper.css">Paper</option>
				<option value="readable.css">Readable</option>
				<option value="sandstone.css">Sandstone</option>
				<option value="simplex.css">Simplex</option>
				<option value="slate.css">Slate</option>
				<option value="spacelab.css">Spacelab</option>
				<option value="superhero.css">Superhero</option>
				<option value="united.css">United</option>
			</select>
			<span class="help-block">
				Please note that, depending on your connection speed, some themes might take a 
				few seconds to fully load.
			</span>
		</div>
	</div>

	<div id="more-info-demo" class="hidden">
		<div id="more-info-demo-icon" class="pull-left text-success"><i class="glyphicon glyphicon-info-sign"></i></div>
		<p>This is a demo application created using <a href="https://bigprof.com/appgini/">AppGini</a>.
		You can browse it anonymously (read-only access), or <a href="index.php?signIn=1">sign in</a>
		with username <code>demo</code> and password <code>demo</code> to be able to add records
		(you can edit only the records added by <i>demo</i> but not other records.)</p>

		<p>You can as well <a href="membership_signup.php">sign up</a> as a new user. You'll then be able to add records and edit/delete them. You can only view all other records but not edit/delete them.</p>

		<p>User groups and permissions are a built-in feature in all apps created by AppGini.
			You can <a href="https://bigprof.com/appgini/screencasts/managing-access-permissions-for-logged-in-users">see in this screencast how to configure group permissions</a>.</p>
	</div>
	
	<div id="demo-tools" class="hidden text-center">
		<div class="btn-group">
			<button type="button" onclick="location.assign('https://bigprof.com/appgini/');" class="btn btn-primary">
				<span class="hidden-xs">
					<i class="glyphicon glyphicon-heart"></i> Powered by
				</span>
				AppGini <span id="appgini-version"></span>
			</button>
			<button type="button" class="btn btn-primary" id="demo-options">
				<span class="hidden-xs">
					<i class="glyphicon glyphicon-cog"></i> Change theme
				</span>
				<span class="badge" id="demo-theme-name">Bootstrap</span>
			</button>
			<button type="button" class="btn btn-primary" id="show-more-info">
				<i class="glyphicon glyphicon-info-sign"></i>
				<span class="hidden-xs"> More info</span>
			</button>
			<button type="button" class="btn btn-primary" id="hide-demo-tools" title="Hide me!">
				<i class="glyphicon glyphicon-remove"></i>
			</button>
		</div>
	</div>

	<div id="restore-demo-tools" class="hidden text-center">
		<button type="button" class="btn btn-primary" title="Change theme"><i class="glyphicon glyphicon-cog"></i></button>
	</div>
	
	<style>
		#more-info-demo-icon {
			font-size: 4em;
			margin-right: 10px;
			-webkit-transform: rotate(-16deg);
			-ms-transform: rotate(-16deg);
			transform: rotate(-16deg);
		}
		#demo-tools, #restore-demo-tools {
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 1030;
			padding: 5px;
		}
		#restore-demo-tools button {
			box-shadow: 0px 0px 10px 1px #000;
		}
		#demo-tools .btn{
			white-space: normal;
		}
		@media (max-width: 991px){
			#demo-tools .btn { max-width: 32%; }
		}
	</style>
	
	<script>
		$j(function(){
			/* Get AppGini version */
			var appgini_version = $j('.navbar-fixed-bottom small a').text().replace(/[a-z ]*/i, '');
			$j('#appgini-version').html(appgini_version);
			
			/* Remove the bottom nav */
			$j('.navbar-fixed-bottom').remove();
			
			/* Apply navbar color, bgcolor and border styles to #demo-tools */
			$j('#demo-tools').css({
				'border': $j('.navbar').css('border'),
				'background-color': $j('.navbar').css('background-color')
			});
			
			/* Same height for all #demo-tools buttons */
			setTimeout(demoToolsSameHeight, 2500);
			
			$j('#show-more-info').click(function(){
				modal_window({
					message: $j('#more-info-demo').html(),
					title: 'About this demo',
					footer: [{
						label: 'Close',
						bs_class: 'default'
					}]
				});
			});
			
			$j('#demo-options').click(function(){
				$j('.modal').remove(); // only one modal allowed in page
				
				modal_window({
					message: $j('#theme-form').html(),
					title: 'Change the theme of this demo',
					footer: [{
						label: 'Apply',
						bs_class: 'success',
						click: function(){
							var new_theme = $j('.modal select[id=demo-theme]').val();
							//console.log('New theme selected: ' + new_theme);
							//console.log('Old theme cookie: ' + cookie('theme'));
							cookie('theme', new_theme);
							//console.log('New theme cookie: ' + cookie('theme'));
							//location.reload();
							apply_theme(new_theme);
							demoToolsSameHeight();
						}
					}]
				});
				
				$j('.modal select[id=demo-theme]').val(cookie('theme'));
			});

			$j('#hide-demo-tools').click(function() {
				applyDemoToolsVisibility('off');
			});

			$j('#restore-demo-tools').on('click', 'button', function() {
				applyDemoToolsVisibility('on');
			})
		});
	</script>
<?php } ?>

<script>
	function applyDemoToolsVisibility(viz) {
		if(viz === undefined) viz = cookie('displayDemoTools');
		if(viz === 'null') viz = 'on';

		if(viz === 'on') {
			$j('#restore-demo-tools').addClass('hidden');
			$j('#demo-tools').removeClass('hidden');
			demoToolsSameHeight();
		} else {
			$j('#demo-tools').addClass('hidden');
			$j('#restore-demo-tools').removeClass('hidden');			
		}

		cookie('displayDemoTools', viz);
	}

	function apply_theme(new_theme){
		/* get configured theme */
		var theme = new_theme;
		var pre_path = <?php echo json_encode(PREPEND_PATH); ?>;
		theme = theme || cookie('theme');
		theme = theme || 'bootstrap.css'; // default theme if no cookie and no theme passed
		
		if(theme.match(/.*?\.css$/)){
			/* remove default theme */
			$j('link[rel=stylesheet][href*="initializr/css/"]').remove();
			$j('link[rel=stylesheet][href="dynamic.css.php"]').remove();

			/* apply configured theme */
			$j('head').append('<link rel="stylesheet" href="' + pre_path + 'resources/initializr/css/' + theme + '">');
			if(theme == 'bootstrap.css' && !$j('html').hasClass('lt-ie9')){
				$j('head').append('<link rel="stylesheet" href="' + pre_path + 'resources/initializr/css/bootstrap-theme.css">');
			}
			$j('head').append('<link rel="stylesheet" href="' + pre_path + 'dynamic.css.php">');
			
			/* update displayed theme name */
			$j('#demo-theme-name').html(ucfirst(theme.replace(/\.css$/, '')));
		}			
	}
	
	function cookie(name, val){
		if(val !== undefined) createCookie(name, val, 0.1);
		return String(readCookie(name));
	}
	
	function ucfirst(str) {
		str += '';
		var f = str.charAt(0).toUpperCase();
		return f + str.substr(1);
	}

	function createCookie(name, value, days) {
		var expires;

		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}
		document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
	}

	function readCookie(name) {
		var nameEQ = encodeURIComponent(name) + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name, "", -1);
	}

	function demoToolsSameHeight() {
		var max_height = 30;
		$j('#demo-tools .btn').each(function(){
			var bh = $j(this).height();
			if(bh > max_height) max_height = bh;
		});
		$j('#demo-tools .btn').height(max_height);				
	};

	function showDemoInfoOnce() {
		if(cookie('demoInfoShownBefore') === 'yes') return;

		cookie('demoInfoShownBefore', 'yes');
		$j('#show-more-info').click();
	}

	function showInfoInLoginPage() {
		$j('#login_splash').html(
			'<div style="max-width: 600px; margin: 0 auto;"><h1>About this demo</h1>' + 
				$j('#more-info-demo').html() + 
			'</div>'
		);
	}

	// startup
	$j(function(){
		apply_theme();
		applyDemoToolsVisibility();
		showDemoInfoOnce();
		showInfoInLoginPage();
	});
</script>
