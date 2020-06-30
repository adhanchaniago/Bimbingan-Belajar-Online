						<!-- footer -->
						<!-- ============================================================== --> 
						<footer class="footer text-left fixed">
							© 2018 <a href="www.bilikilmu.com" title="Bimbingan belajar gresik"><i>bilikilmu.com</i></a>  |  Created by <a href="www.kazuyamedia.com" title="Software House | Kazuya Media">Kazuya Media Indonesia</a>
						</footer>
						<!-- ============================================================== -->
						<!-- End footer -->
						<!-- ============================================================== -->
					</div>
					<!-- ============================================================== -->
					<!-- End Page wrapper  -->
					<!-- ============================================================== -->
				</div>
				<!-- ============================================================== -->
				<!-- End Wrapper -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- All Jquery -->
				<!-- ============================================================== -->
				<!-- Bootstrap tether Core JavaScript -->
				<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
				<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
				<!-- slimscrollbar scrollbar JavaScript -->
				<script src="<?= base_url(); ?>assets/js/jquery.slimscroll.js"></script>
				<!--Wave Effects -->
				<script src="<?= base_url(); ?>assets/js/waves.js"></script>
				<!--Menu sidebar -->
				<script src="<?= base_url(); ?>assets/js/sidebarmenu.js"></script>
				<!--stickey kit -->
				<script src="<?= base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
				<!--Custom JavaScript -->
				<script src="<?= base_url(); ?>assets/js/custom.min.js"></script>
				<!-- ============================================================== -->
				<!-- This page plugins -->
				<!-- ============================================================== -->
				<!--sparkline JavaScript -->
				<script src="<?= base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
				<!--morris JavaScript -->
				<script src="<?= base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>
				<script src="<?= base_url(); ?>assets/plugins/morrisjs/morris.min.js"></script>
				<!-- Chart JS -->
				<!-- <script src="<?= base_url(); ?>assets/js/dashboard1.js"></script> -->
				<!-- ============================================================== -->
				<!-- Style switcher -->
				<!-- ============================================================== -->
				<!-- <script src="<?= base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> -->
				<!-- <script src="<?= base_url(); ?>assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script> -->

				<!-- icheck -->
				<script src="<?= base_url(); ?>assets/plugins/icheck/icheck.min.js"></script>
				<script src="<?= base_url(); ?>assets/plugins/icheck/icheck.init.js"></script>
				<!-- pemisah titik -->
				<script src="<?= base_url(); ?>assets/js/pemisahTitik.js"></script>
				<!-- This is data table -->	
				<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
				<!-- start - This is for export functionality only -->
				<script src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
				<script src="<?= base_url(); ?>assets/js/buttons.flash.min.js"></script>
				<script src="<?= base_url(); ?>assets/js/jszip.min.js"></script>
				<script src="<?= base_url(); ?>assets/js/pdfmake.min.js"></script>
				<script src="<?= base_url(); ?>assets/js/vfs_fonts.js"></script>
				<script src="<?= base_url()	; ?>assets/js/buttons.html5.min.js"></script>
				<script src="<?= base_url(); ?>assets/js/buttons.print.min.js"></script>
				<!-- end - This is for export functionality only -->

				<!-- select 2 form -->
				<script src="<?= base_url(); ?>assets/js/select2form.js"></script>

				<!-- Print Area JS -->
				<script src="<?= base_url();?>assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>

				<!-- bootbox alert -->
				<script src="<?= base_url(); ?>assets/bootbox/bootbox.min.js" type="text/javascript"></script>
				<script src="<?= base_url(); ?>assets/bootbox/bootbox.locales.min.js" type="text/javascript"></script>
				<!-- <script src="<?= base_url(); ?>assets/bootbox/bootbox.all.min.js" type="text/javascript"></script> -->
				
				<!-- ============================================================== -->
				<!-- Style switcher -->
				<!-- ============================================================== -->
				<script src="<?= base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
				<script>
					ko.bindingHandlers.checkId = {
						init: function (element, valueAccessor) {
							$(element).on("keydown", function (e) {
								return true;
							});
							$(element).on("keyup", function (e) {
								var valId = $(element).val();
								ajaxPost(valueAccessor(), {id: valId}, function (res) {
									if(res.res == 'Data Sama'){
										model.CheckId(true);
										$(element).closest('.form-group').addClass('has-warning');
										$(element).addClass('form-control-warning');
									} else {
										model.CheckId(false);
										$(element).closest('.form-group').removeClass('has-warning');
										$(element).removeClass('form-control-warning');
									}
								});
							});
						}
					};
					ko.bindingHandlers.numeric = {
						init: function (element, valueAccessor) {
							$(element).on("keydown", function (e) {
								if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
									return false;
								}
							});
							$(element).on("keyup", function (e) {
								
							});
						}
					};
					ko.bindingHandlers.readonly = {
						update: function (element, valueAccessor) {
							if (valueAccessor() == 'show') {
								$(element).attr("readonly", "readonly");
								$(element).addClass("disabled");
							} else {
								$(element).removeAttr("readonly");
								$(element).removeClass("disabled");
							}
						}
					};
					model.activetab = function(index){
						$("#tabnavform li>.nav-link").removeClass("active");
						$("#tabnavform li>.nav-link").attr({"aria-expanded":false});
						$("#tabnavform li>.nav-link").eq(index).addClass("active");
						$("#tabnavform li>.nav-link").eq(index).attr({"aria-expanded":true});
						$("#tabnavform-content div.tab-pane").removeClass("active");
						$("#tabnavform-content div.tab-pane").attr({"aria-expanded":false});
						$("#tabnavform-content div.tab-pane").eq(index).addClass("active");
						$("#tabnavform-content div.tab-pane").eq(index).attr({"aria-expanded":true});
					}
					function changeRupiah(angka){
						var minus = false;
						if (angka < 0) {
							minus = true;
							angka = angka * -1;
						}
						var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
						var rev2    = '';
						for(var i = 0; i < rev.length; i++){
							rev2  += rev[i];
							if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
								rev2 += '.';
							}
						}
						if (minus)
							return "-" + rev2.split('').reverse().join('');
						else
							return rev2.split('').reverse().join('');
					}
					function terbilang(bilangan){
						var kalimat="";
						var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
						var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
						var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
						var panjang_bilangan = bilangan.length;

						/* pengujian panjang bilangan */
						if(panjang_bilangan > 15){
							kalimat = "Diluar Batas";
						}else{
							/* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
							for(i = 1; i <= panjang_bilangan; i++) {
								angka[i] = bilangan.substr(-(i),1);
							}

							var i = 1;
							var j = 0;

							/* mulai proses iterasi terhadap array angka */
							while(i <= panjang_bilangan){
								subkalimat = "";
								kata1 = "";
								kata2 = "";
								kata3 = "";

								/* untuk Ratusan */
								if(angka[i+2] != "0"){
									if(angka[i+2] == "1"){
										kata1 = "Seratus";
									}else{
										kata1 = kata[angka[i+2]] + " Ratus";
									}
								}

								/* untuk Puluhan atau Belasan */
								if(angka[i+1] != "0"){
									if(angka[i+1] == "1"){
										if(angka[i] == "0"){
											kata2 = "Sepuluh";
										}else if(angka[i] == "1"){
											kata2 = "Sebelas";
										}else{
											kata2 = kata[angka[i]] + " Belas";
										}
									}else{
										kata2 = kata[angka[i+1]] + " Puluh";
									}
								}

								/* untuk Satuan */
								if (angka[i] != "0"){
									if (angka[i+1] != "1"){
										kata3 = kata[angka[i]];
									}
								}

								/* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
								if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
									subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
								}

								/* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
								kalimat = subkalimat + kalimat;
								i = i + 3;
								j = j + 1;
							}

							/* mengganti Satu Ribu jadi Seribu jika diperlukan */
							if ((angka[5] == "0") && (angka[6] == "0")){
								kalimat = kalimat.replace("Satu Ribu","Seribu");
							}
						}
						return kalimat;
					}
					function ajaxPost(url, data, callbackSuccess, callbackError, otherConfig) {
						var startReq = moment();
						var callbackScheduler = function (callback) {
							callback();
						};
						if (typeof callbackSuccess == "object") {
							otherConfig = callbackSuccess;
							callbackSuccess = function () { };
							callbackError = function () { };
						} 
						if (typeof callbackError == "object") {
							otherConfig = callbackError;
							callbackError = function () { };
						} 
						var config = {
							url: url,
							type: 'post',
							dataType: 'json',
							contentType: 'application/json; charset=utf-8',
							data: ko.mapping.toJSON(data),
							success: function (a) {
								callbackScheduler(function () {
									if (callbackSuccess !== undefined) {
										callbackSuccess(a);
									}
								});
							},
							error: function (a, b, c) {
								callbackScheduler(function () {
									if (callbackError !== undefined) {
										callbackError(a, b, c);
									}
								});
							}
						};
						if (data instanceof FormData) {
							delete config.config;
							config.data = data;
							config.async = false;
							config.cache = false;
							config.contentType = false;
							config.processData = false;
						}
						if (otherConfig != undefined) {
							config = $.extend(true, config, otherConfig);
						}
						return $.ajax(config);
					};

					ko.applyBindings(model);
					$(document).ready(function () {
						model.Processing(false);
					});
				</script>
			</body>
			</html>