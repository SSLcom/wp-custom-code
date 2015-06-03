<div class="wrap">  
    <div id="icon-themes" class="icon32"></div>  
    <h2>Custom Code by <a href="https://www.ssl.com"><img src="http://sslcom.github.io/bootstrap-hpanel/images/SSLcom-Dark.svg" height="30"></a></h2>  
    <?php settings_errors(); ?>  

    <?php  
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'welcome';  
    ?>  

    <h2 class="nav-tab-wrapper">  
        <a href="?page=sslcom_cc&tab=welcome" class="nav-tab <?php echo $active_tab == 'welcome' ? 'nav-tab-active' : ''; ?>">Welcome</a>
        <a href="?page=sslcom_cc&tab=bundle" class="nav-tab <?php echo $active_tab == 'bundle' ? 'nav-tab-active' : ''; ?>"></a>  
        <a href="?page=sslcom_cc&tab=html" class="nav-tab <?php echo $active_tab == 'html' ? 'nav-tab-active' : ''; ?>">HTML</a>  
        <a href="?page=sslcom_cc&tab=php" class="nav-tab <?php echo $active_tab == 'php' ? 'nav-tab-active' : ''; ?>">PHP</a>
        <a href="?page=sslcom_cc&tab=css" class="nav-tab <?php echo $active_tab == 'css' ? 'nav-tab-active' : ''; ?>">CSS</a>
        <a href="?page=sslcom_cc&tab=js" class="nav-tab <?php echo $active_tab == 'js' ? 'nav-tab-active' : ''; ?>">JavaScript</a>  
    </h2>

    <?php
        if (isset($_GET['edit'])) include_once(dirname(__FILE__) . "/fragments/edit_code.php");
        elseif (isset($_GET['delete']) && $_GET['delete'] !== '') {
            $file = dirname(__FILE__) . "/".$active_tab."/".$_GET['delete'];
            if (file_exists($file)) {
                unlink($file);
                include_once(dirname(__FILE__) . '/' . "list_code.php");
            }
        }
        else {
        	if($active_tab !== "welcome") include_once(dirname(__FILE__) . '/' . "list_code.php");
        	else include_once(dirname(__FILE__) . "/fragments/welcome.php");
        }
	?>
</div>