<?php

ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
session_start();
if(!isset($_POST['noflush']))
	ob_end_flush();
//$loc = $_SESSION['loc'];
//$locr = $_SESSION['locr'];
$loc = $locr = "..";
$runphp = "run.php";
$runeditphp = "runedit.php";

require_once("$locr/globals.php");
require_once("$locr/db.php");

if(!isset($_POST['noflush'])) {
	require_once("$locr/version.php");
	echo "<html><head><title>Admin's Page</title>\n";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
	// echo "<link rel=stylesheet href=\"$loc/Css.php\" type=\"text/css\">\n";
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="vendor/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel=stylesheet href="vendor/assets/css/argon.min.css" type="text/css">
	
    <?php
}

if(!ValidSession()) {
	InvalidSession("admin/index.php");
        ForceLoad("$loc/index.php");
}
if($_SESSION["usertable"]["usertype"] != "admin") {
	IntrusionNotify("admin/index.php");
	ForceLoad("$loc/index.php");
}

if ((isset($_GET["Submit1"]) && $_GET["Submit1"] == "Transfer") ||
    (isset($_GET["Submit3"]) && $_GET["Submit3"] == "Transfer scores")) {
  echo "<meta http-equiv=\"refresh\" content=\"60\" />";
}

echo "</head>\n";
/*
if(!isset($_POST['noflush'])) {
	echo "</head><body id=\"body\"><table border=1 width=\"100%\">\n";
	echo "<tr><td nowrap bgcolor=\"eeee00\" align=center>";
	echo "<img src=\"../images/smallballoontransp.png\" alt=\"\">";
	echo "<font color=\"#000000\">BOCA</font>";
	echo "</td><td bgcolor=\"#eeee00\" width=\"99%\">\n";
	echo "Username: " . $_SESSION["usertable"]["userfullname"] . " (site=".$_SESSION["usertable"]["usersitenumber"].")<br>\n";
	list($clockstr,$clocktype)=siteclock();
	echo "</td><td bgcolor=\"#eeee00\" align=center nowrap>&nbsp;".$clockstr."&nbsp;</td></tr>\n";
	echo "</table>\n";
	echo "<table border=0 width=\"100%\" align=center>\n";
	echo " <tr>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=run.php>Runs</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=score.php>Score</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=clar.php>Clarifications</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=user.php>Users</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=problem.php>Problems</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=language.php>Languages</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=answer.php>Answers</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=misc.php>Misc</a></td>\n";
//echo " </tr></table><hr><table border=0 width=\"100%\" align=center><tr>\n";
	echo " </tr><tr>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=task.php>Tasks</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=site.php>Site</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=contest.php>Contest</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=log.php>Logs</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=report.php>Reports</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=files.php>Backups</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=option.php>Options</a></td>\n";
	echo "  <td align=center><a class=menu style=\"font-weight:bold\" href=$loc/index.php>Logout</a></td>\n";
	echo " </tr>\n"; 
	echo "</table>\n";
}
*/

//if(decryptData(encryptData("aaaaa","senha"),"senha")) MSGError("yay");



?>

<body>

<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <span>BOCA - DEMO</span>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="run.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Runs</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="score.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Score</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clar.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Clarifications</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="problem.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Problems</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="lenguage.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Lenguajes</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="answer.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Answers</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="misc.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Misc</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="task.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Tasks</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="site.php">
       <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Site</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contest.php">
                 <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Contest</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="log.php">
                 <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Logs</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="report.php">
                 <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Reports</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="files.php">
                 <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Backups</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="option.php">
                 <i class="fas fa-chevron-right"></i>
                <span class="nav-link-text">Options</span>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <span></span>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
           
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="vendor/assets/img/theme/user-img.png">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION["usertable"]["userfullname"] . " (site=".$_SESSION["usertable"]["usersitenumber"].")" ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h5 class=" m-0">
                    <?php
                      list($clockstr,$clocktype)=siteclock();
                      echo $clockstr;
                    ?>
                  </h6>
                </div>
                <div class="dropdown-divider"></div>
                <a  class="dropdown-item" href="<?php echo $loc.'/index.php'?>"> 
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>



