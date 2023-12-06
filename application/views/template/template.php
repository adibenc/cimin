<!DOCTYPE html>
<html lang="en">

<head>
	<base href="../" />
	<title>App</title>
	<meta charset="utf-8" />
	<meta name="description"
		content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords"
		content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="shortcut icon" href="<?=base_url()?>assets/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="<?=base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<script>
	// global pub data
	let baseUrl = "<?= $_baseurl ?>"
	let gdata = {
		_role: "<?= $_role ?>",
		_user: <?= json_encode($_user) ?>,
		_inst_satkerkd: "<?= $_inst_satkerkd ?>"
	}
	routes = {}
	</script>
</head>

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
	data-kt-app-toolbar-enabled="true" class="app-default">
	<!-- ui here -->
	
	<script>
	var defaultThemeMode = "light";
	var themeMode;
	if (document.documentElement) {
		if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
			themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
		} else {
			if (localStorage.getItem("data-bs-theme") !== null) {
				themeMode = localStorage.getItem("data-bs-theme");
			} else {
				themeMode = defaultThemeMode;
			}
		}
		if (themeMode === "system") {
			themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
		}
		document.documentElement.setAttribute("data-bs-theme", themeMode);
	}
	</script>

	<script>
	var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="<?=base_url()?>assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?=base_url()?>assets/js/scripts.bundle.js"></script>
	<script type="text/javascript" src="<?= $_baseurl ?>assets/js/app.js"></script>
	<script type="text/javascript" src="<?= $_baseurl ?>assets/js/util.js"> </script>

	<?= $_scripts ?>
</body>
<!--end::Body-->

</html>