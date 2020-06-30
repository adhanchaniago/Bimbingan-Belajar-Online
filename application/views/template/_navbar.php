			 <div id="main-wrapper">
			 	<!-- ============================================================== -->
			 	<!-- Topbar header - style you can find in pages.scss -->
			 	<!-- ============================================================== -->
			 	<header class="topbar">
			 		<nav class="navbar top-navbar navbar-expand-md navbar-light">
			 			<!-- ============================================================== -->
			 			<!-- Logo -->
			 			<!-- ============================================================== -->
			 			<div class="navbar-header">
			 				<a class="navbar-brand" href="index.html">
			 					<!-- Logo icon --><b>
			 						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
			 						<!-- Dark Logo icon -->
			 						<img src="<?= base_url(); ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
			 						<!-- Light Logo icon -->
			 						<img src="<?= base_url(); ?>assets/images/logo-light-icon.PNG" alt="homepage" class="light-logo" />
			 					</b>
			 					<!--End Logo icon -->
			 					<!-- Logo text --><span>
			 						<!-- dark Logo text -->
			 						<img src="<?= base_url(); ?>assets/images/logo-text2.png" alt="homepage" class="dark-logo" />
			 						<!-- Light Logo text -->    
			 						<img src="<?= base_url(); ?>assets/images/logo-light-text.PNG" class="light-logo" alt="homepage" /></span> 

			 					</a>
			 				</div>
			 				<!-- ============================================================== -->
			 				<!-- End Logo -->
			 				<!-- ============================================================== -->
			 				<div class="navbar-collapse">
			 					<!-- ============================================================== -->
			 					<!-- toggle and nav items -->
			 					<!-- ============================================================== -->
			 					<ul class="navbar-nav mr-auto mt-md-0">
			 						<!-- This is  -->
			 						<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
			 						<!-- ============================================================== -->
			 						<!-- Comment -->
			 						<!-- ============================================================== -->
			 						<li class="nav-item dropdown">

			 						</li>
			 						<!-- ============================================================== -->
			 						<!-- End Comment -->
			 						<!-- ============================================================== -->
			 					</ul>
			 					<!-- ============================================================== -->
			 					<!-- User profile and search -->
			 					<!-- ============================================================== -->
			 					<ul class="navbar-nav my-lg-0">
			 					</ul>
			 				</div>
			 			</nav>
			 		</header>
			 		<<a href="mailto:joe@example.com?subject=feedback" "email me">email me</a>
			 		<!-- ============================================================== -->
			 		<!-- End Topbar header -->
			 		<!-- ============================================================== -->
			 		<!-- ============================================================== -->
			 		<!-- Left Sidebar - style you can find in sidebar.scss  -->
			 		<!-- ============================================================== -->
			 		<aside class="left-sidebar">
			 			<!-- Sidebar scroll-->
			 			<div class="scroll-sidebar">
			 				<!-- Sidebar navigation-->
			 				<nav class="sidebar-nav">
			 					<ul id="sidebarnav">
			 						<li class="nav-small-cap">PERSONAL</li> 
			 						<li> <a href="<?= base_url('Admin'); ?>"  class=" waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-gauge"></i>Dashboard</a> 
			 						</li>
			 						<?php $parent = "
			 						SELECT m1.menuparentid, m1.menuname, m1.menuid, (select m2.menuname from tb_menu m2 where m2.menuid=m1.menuparentid) AS menuparentname, m1.menulink, m1.menuicon FROM tb_menu AS m1
			 						WHERE m1.menuparentid=m1.menuparentid AND m1.menuparentid='0' 
			 						GROUP BY m1.menusort ASC";
			 						$parent = $this->db->query($parent);

			 						foreach ($parent->result() as $p) {
                                                        // chek dulu
			 							$child = " SELECT
			 							m1.menuid, m1.menuparentid, m1.menuname, m1.menuid, (select m2.menuname from tb_menu m2 where m2.menuid=m1.menuparentid) AS menuparentname, m1.menulink, m1.alias, m1.menuicon
			 							FROM tb_menu AS m1
			 							LEFT JOIN tb_menu AS m2 ON m1.menuid = m2.menuparentid
			 							WHERE m1.menuparentid=m1.menuparentid
			 							AND m1.menuparentid='$p->menuid' 
			 							GROUP BY m1.menuid
			 							";
			 							$child = $this->db->query($child);

														// $child = $this->db->get_where('tb_menu', array('menuparentid' => $p->menuid));
														// print_r($child->num_rows());die();
			 							if ($child->num_rows() > 0) {
														// tampilkan submenu
			 								?> 
			 								<li><a href="#"  class=" has-arrow waves-effect waves-dark" ><i class="<?= $p->menuicon;?>" ></i><?= $p->menuname;?></a>
			 									<?php
			 									echo " <ul aria-expanded='false' class='collapse'>";
			 									foreach ($child->result() as $c) {
			 										echo "<li>" . anchor($c->alias, $c->menuname, array('class' => '')) . "</li>";
			 									}
			 									echo "</ul></li>";
			 								} else {
			 									echo "<li>
			 									<a href='#' class='has-arrow waves-effect waves-dark' ><i class='".$p->menuicon."'></i>".$p->menuname."
			 									</a>

			 									</li>";
			 								}
			 							} 
			 							?> 
			 						</li>
			 					</ul>
			 				</nav>
			 				<!-- End Sidebar navigation -->
			 			</div>
			 			<!-- End Sidebar scroll-->
			 		</aside>
			 		<!-- ============================================================== -->
			 		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
			 		<!-- ============================================================== -->
			 		<script type="text/javascript">
			 		</script>