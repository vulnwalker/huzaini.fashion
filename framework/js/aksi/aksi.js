var aksi = new DaftarObj2({
	prefix : 'aksi',
	url : 'framework/pages.php?Pg=aksi',
	formName : 'aksiForm',

	loading: function(){
		//alert('loading');
		this.topBarRender();
		this.filterRender();
		this.daftarRender();
		this.sumHalRender();

	},

	detail: function(){
		//alert('detail');
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){
			var box = this.GetCbxChecked();
			//UserAktivitasDet.genDetail();

		}else{
			alert(errmsg);
		}

	},
	daftarRender:function(){
		var me =this; //render daftar
		addCoverPage2(
			'daftar_cover',	1, 	true, true,	{renderTo: this.prefix+'_cont_daftar',
			imgsrc: 'images/wait.gif',
			style: {position:'absolute', top:'5', left:'5'}
			}
		);
		$.ajax({
		  	url: this.url+'&tipe=daftar',
		 	type:'POST',
			data:$('#'+this.formName).serialize(),
		  	success: function(data) {
				var resp = eval('(' + data + ')');
				document.getElementById(me.prefix+'_cont_daftar').innerHTML = resp.content;
				me.sumHalRender();
		  	}
		});
	},
	Baru: function(){

		var me = this;
		var err='';

		if (err =='' ){
			var cover = this.prefix+'_formcover';
			document.body.style.overflow='hidden';
			addCoverPage2(cover,1,true,false);
			$.ajax({
				type:'POST',
				data:$('#'+this.formName).serialize(),
			  	url: this.url+'&tipe=formBaru',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					document.getElementById(cover).innerHTML = resp.content;
					document.getElementById('kode1').focus();
					me.AfterFormBaru();
			  	}
			});

		}else{
		 	alert(err);
		}
	},
	Edit:function(){
		var me = this;
		errmsg = this.CekCheckbox();
		if(errmsg ==''){
			var box = this.GetCbxChecked();

			//this.Show ('formedit',{idplh:box.value}, false, true);
			var cover = this.prefix+'_formcover';
			addCoverPage2(cover,999,true,false);
			document.body.style.overflow='hidden';
			$.ajax({
				type:'POST',
				data:$('#'+this.formName).serialize(),
				url: this.url+'&tipe=formEdit',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
						document.getElementById(cover).innerHTML = resp.content;
						document.getElementById('kode1').focus();
						me.AfterFormEdit(resp);
					}else{
						alert(resp.err);
						delElem(cover);
						document.body.style.overflow='auto';
					}
			  	}
			});
		}else{
			alert(errmsg);
		}

	},
	Hapus:function(){

		var me =this;
		if(document.getElementById(this.prefix+'_jmlcek')){
			var jmlcek = document.getElementById(this.prefix+'_jmlcek').value ;
		}else{
			var jmlcek = '';
		}

		if(jmlcek ==0){
			alert('Data Belum Dipilih!');
		}else{
			if(confirm('Hapus '+jmlcek+' Data ?')){
				//document.body.style.overflow='hidden';
				var cover = this.prefix+'_hapuscover';
				addCoverPage2(cover,1,true,false);
				$.ajax({
					type:'POST',
					data:$('#'+this.formName).serialize(),
					url: this.url+'&tipe=hapus',
				  	success: function(data) {
						var resp = eval('(' + data + ')');
						delElem(cover);
						if(resp.err==''){
							me.Close();
							me.refreshList(true)
						}else{
							alert(resp.err);
						}

				  	}
				});

			}
		}
	},

	Simpan: function(){
		var me= this;
		this.OnErrorClose = false
		document.body.style.overflow='hidden';
		var cover = this.prefix+'_formsimpan';
		addCoverPage2(cover,1,true,false);
		/*this.sendReq(
			this.url,
			{ idprs: 0, daftarProses: new Array('simpan')},
			this.formDialog);*/
		$.ajax({
			type:'POST',
			data:$('#'+this.prefix+'_form').serialize(),
			url: this.url+'&tipe=simpan',
		  	success: function(data) {
				var resp = eval('(' + data + ')');
				delElem(cover);
				//document.getElementById(cover).innerHTML = resp.content;
				if(resp.err==''){
					me.Close();
					me.AfterSimpan();
				}else{
					alert(resp.err);
				}
		  	}
		});
	},
	hubla: function(){
		alert("nyala");
	}
	,
	register: function(){
		$.ajax({
				type:'POST',
				data:$('#formRegister').serialize(),
				url: this.url+'&tipe=register',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
						   window.location.reload();
					}else{
						alert(resp.err);

					}
			  	}
			});
	}
	,

	provinsiChanged: function(){
		$.ajax({
				type:'POST',
				data: {
								idProvinisi : $("#cmbProvinsi").val()
				},
				url: this.url+'&tipe=provinsiChanged',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
						   document.getElementById('cmbKota').innerHTML = resp.content.kota;
							 document.getElementById('cmbKecamatan').innerHTML = resp.content.kecamatan;
					}else{
						alert(resp.err);

					}
			  	}
			});
	}
	,

	kotaChanged: function(){
		$.ajax({
				type:'POST',
				data: {
								idProvinisi : $("#cmbProvinsi").val(),
								idKota : $("#cmbKota").val(),
				},
				url: this.url+'&tipe=kotaChanged',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
						   document.getElementById('cmbKecamatan').innerHTML = resp.content.kecamatan;
					}else{
						alert(resp.err);

					}
			  	}
			});
	}
	,


	checkAlamat: function(){
		if($("#cmbProvinsi").val() == ''){
			alert("Pilih Provinsi");
		}else if($("#cmbKota").val() == ''){
			alert("Pilih Kota");
		}else if($("#cmbKecamatan").val() == ''){
			alert("Pilih Kecamatan");
		}else if($("#alamat").val() == ''){
			alert("Isi Alamat");
		}else if($("#tlp").val() == ''){
			alert("Isi Nomor Telepon");
		}else{

		}
	}
	,

	addToCart: function(id){
		$.ajax({
				type:'POST',
				data:{id : id},
				url: this.url+'&tipe=addToCart',
			  	success: function(data) {
					var resp = eval('(' + data + ')');
					if (resp.err ==''){
					 $("#jumlahBeli").text(resp.content.jumlahBeli);
					}else{
						alert(resp.err);

					}
			  	}
			});
	}


	,

	editProfile: function(){
		var me = this;
		if($("#namaLengkap").val() == ''){
			alert("Isi Nama Lengkap");
		}else if($("#email").val() == ''){
			alert("Isi Email");
		}else if(!me.validateEmail($("#email").val())){
			alert("Email Tidak Valid");
		}else if($("#alamat").val() == ''){
			alert("Isi Alamat");
		}else if($("#tlp").val() == ''){
			alert("Isi Nomor Telepon");
		}else{
				$.ajax({
						type:'POST',
						data:{
										namaLengkap : $("#namaLengkap").val(),
										email : $("#email").val(),
										alamat : $("#alamat").val(),
										telepon : $("#tlp").val(),
										username : $("#uname").val(),

									},
						url: this.url+'&tipe=updateProfile',
					  	success: function(data) {
								var resp = eval('(' + data + ')');
									alert("Profile Updated");
									window.location.reload();
					  	}
					});
		}

	},

	 validateEmail: function(email) {
		  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  return re.test(email);
		}

});
