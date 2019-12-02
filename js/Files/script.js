var currentPath='';
$(document).ready(function(){
	var filemanager = $('.filemanager'),
		breadcrumbs = $('.breadcrumbs'),
		fileList = filemanager.find('.data');

	// Start by fetching the file data from scan.php with an AJAX request
$('#saveFolder').click(function(){
		var nameFolder=$('#nameFolder').val();
    	$.post('Files/createFolder',{currentPath: currentPath, nameFolder: nameFolder}, function(data) {
			alertify.success('Directorio creado correctamente');
			setTimeout(() => {				
				location.reload();
			}, 500);
    	});
    });
	$.get('Files/scanDirectory', function(data) {
			currentPath = '';
		var response = [data],
			breadcrumbsUrls = [];

		var folders = [],
			files = [];

		// This event listener monitors changes on the URL. We use it to
		// capture back/forward navigation in the browser.

		$(window).on('hashchange', function(){

			goto(window.location.hash);

			// We are triggering the event. This will execute 
			// this function on page load, so that we show the correct folder:

		}).trigger('hashchange');


		// Hiding and showing the search box

		filemanager.find('.search').click(function(){

			var search = $(this);

			search.find('span').hide();
			search.find('input[type=search]').show().focus();

		});

		$('#createFolder').click(function(){
			$('#pathNewFolder').html('Crear carpeta en '+currentPath+'/');
			$('#exampleModalCenter').modal('show');
	});
		// Listening for keyboard input on the search field.
		// We are using the "input" event which detects cut and paste
		// in addition to keyboard input.

		filemanager.find('input').on('input', function(e){

			folders = [];
			files = [];

			var value = this.value.trim();

			if(value.length) {

				filemanager.addClass('searching');

				// Update the hash on every key stroke
				window.location.hash = 'search=' + value.trim();

			}

			else {

				filemanager.removeClass('searching');
				window.location.hash = encodeURIComponent(currentPath);

			}

		}).on('keyup', function(e){

			// Clicking 'ESC' button triggers focusout and cancels the search

			var search = $(this);

			if(e.keyCode == 27) {

				search.trigger('focusout');

			}

		}).focusout(function(e){

			// Cancel the search

			var search = $(this);

			if(!search.val().trim().length) {

				window.location.hash = encodeURIComponent(currentPath);
				search.hide();
				search.parent().find('span').show();

			}

		});


		// Clicking on folders

		fileList.on('click', 'li.folders', function(e){
			e.preventDefault();

			var nextDir = $(this).find('a.folders').attr('href');

			if(filemanager.hasClass('searching')) {

				// Building the breadcrumbs

				breadcrumbsUrls = generateBreadcrumbs(nextDir);

				filemanager.removeClass('searching');
				filemanager.find('input[type=search]').val('').hide();
				filemanager.find('span').show();
			}
			else {
				breadcrumbsUrls.push(nextDir);
			}

			window.location.hash = encodeURIComponent(nextDir);
			currentPath = nextDir;
		});

		
		



		// Clicking on breadcrumbs

		breadcrumbs.on('click', 'a', function(e){
			e.preventDefault();

			var index = breadcrumbs.find('a').index($(this)),
				nextDir = breadcrumbsUrls[index];

			breadcrumbsUrls.length = Number(index);

			window.location.hash = encodeURIComponent(nextDir);

		});


		// Navigates to the given hash (path)

		function goto(hash) {

			hash = decodeURIComponent(hash).slice(1).split('=');

			if (hash.length) {
				var rendered = '';

				// if hash has search in it

				if (hash[0] === 'search') {

					filemanager.addClass('searching');
					rendered = searchData(response, hash[1].toLowerCase());

					if (rendered.length) {
						currentPath = hash[0];
						render(rendered);
					}
					else {
						render(rendered);
					}

				}

				// if hash is some path

				else if (hash[0].trim().length) {

					rendered = searchByPath(hash[0]);

					if (rendered.length) {

						currentPath = hash[0];
						breadcrumbsUrls = generateBreadcrumbs(hash[0]);
						render(rendered);

					}
					else {
						currentPath = hash[0];
						breadcrumbsUrls = generateBreadcrumbs(hash[0]);
						render(rendered);
					}

				}

				// if there is no hash

				else {
					currentPath = data.path;
					breadcrumbsUrls.push(data.path);
					render(searchByPath(data.path));
				}
			}
		}

		// Splits a file path and turns it into clickable breadcrumbs

		function generateBreadcrumbs(nextDir){
			var path = nextDir.split('/').slice(0);
			for(var i=1;i<path.length;i++){
				path[i] = path[i-1]+ '/' +path[i];
			}
			return path;
		}


		// Locates a file by path

		function searchByPath(dir) {
			var path = dir.split('/'),
				demo = response,
				flag = 0;

			for(var i=0;i<path.length;i++){
				for(var j=0;j<demo.length;j++){
					if(demo[j].name === path[i]){
						flag = 1;
						demo = demo[j].items;
						break;
					}
				}
			}

			demo = flag ? demo : [];
			return demo;
		}


		// Recursively search through the file tree

		function searchData(data, searchTerms) {

			data.forEach(function(d){
				if(d.type === 'folder') {

					searchData(d.items,searchTerms);

					if(d.name.toLowerCase().match(searchTerms)) {
						folders.push(d);
					}
				}
				else if(d.type === 'file') {
					if(d.name.toLowerCase().match(searchTerms)) {
						files.push(d);
					}
				}
			});
			return {folders: folders, files: files};
		}


		// Render the HTML for the file manager

		function render(data) {
			var scannedFolders = [],
				scannedFiles = [];

			if(Array.isArray(data)) {

				data.forEach(function (d) {

					if (d.type === 'folder') {
						scannedFolders.push(d);
					}
					else if (d.type === 'file') {
						scannedFiles.push(d);
					}

				});

			}
			else if(typeof data === 'object') {

				scannedFolders = data.folders;
				scannedFiles = data.files;

			}


			// Empty the old result and make the new one

			fileList.empty().hide();

			if(!scannedFolders.length && !scannedFiles.length) {
				filemanager.find('.nothingfound').show();
			}
			else {
				filemanager.find('.nothingfound').hide();
			}

			if(scannedFolders.length) {

				scannedFolders.forEach(function(f) {

					var itemsLength = f.items.length,
						name = escapeHTML(f.name),
						icon = '<span class="icon folder"></span>';

					if(itemsLength) {
						icon = '<span class="icon folder full"></span>';
					}

					if(itemsLength == 1) {
						itemsLength += ' item';
					}
					else if(itemsLength > 1) {
						itemsLength += ' items';
					}
					else {
						itemsLength = 'Sin contenido';
					}

					var folder = $('<li class="folders"><a href="'+ f.path +'" title="'+ f.path +'" class="folders">'+icon+'<span class="name">' + name + '</span> <span class="details">' + itemsLength + '</span></a></li>');
					folder.appendTo(fileList);
				});

			}

			if(scannedFiles.length) {

				scannedFiles.forEach(function(f) {

					var fileSize = bytesToSize(f.size),
						name = escapeHTML(f.name),
						fileType = name.split('.'),
						icon = '<span class="icon file"></span>';

					fileType = fileType[fileType.length-1];

					icon = '<span class="icon file f-'+fileType+'">.'+fileType+'</span>';

					var file = $('<li class="files"><a href="'+ f.path+'" title="'+ f.path +'" class="files">'+icon+'<span class="name">'+ name +'</span> <span class="details">'+fileSize+'</span></a></li>');
					file.appendTo(fileList);
				});

			}


			// Generate the breadcrumbs

			var url = '';

			if(filemanager.hasClass('searching')){

				url = '<span>Search results: </span>';
				fileList.removeClass('animated');

			}
			else {

				fileList.addClass('animated');

				breadcrumbsUrls.forEach(function (u, i) {

					var name = u.split('/');

					if (i !== breadcrumbsUrls.length - 1) {
						url += '<a href="'+u+'"><span class="folderName">' + name[name.length-1] + '</span></a> <span class="arrow">→</span> ';
					}
					else {
						url += '<span class="folderName">' + name[name.length-1] + '</span>';
					}

				});

			}

			breadcrumbs.text('').append(url);


			// Show the generated elements
			fileList.fadeIn().css("display","inline-block");
			//fileList.animate({'display':'inline-block'});

		}


		// This function escapes special html characters in names

		function escapeHTML(text) {
			return text.replace(/\&/g,'&amp;').replace(/\</g,'&lt;').replace(/\>/g,'&gt;');
		}


		// Convert file sizes from bytes to human readable units

		function bytesToSize(bytes) {
			var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
			if (bytes == 0) return '0 Bytes';
			var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
			return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
		}

	});



	$('#upload_form').on('submit', function (e) {
        e.preventDefault();
        if ($('#image_file').val() == '') {
            alert("Por favor seleccione un archivo");
        }
        else {
			var form = new FormData(this);
			form.append("path", currentPath);
              $.ajax({
                url: "Files/fileStore",
                method: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (res) {
                    console.log(res.success);
                    if (res.success == true) {
                        $('#blah').attr('src', 'img/no_image_available.jpg');
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 1000
                        });
						$('#modalSubirArchivo').modal('hide');
						setTimeout(function () {
							location.reload('/Files');
					  }, 1200);
                    }
                    else if (res.success == false) {
                         Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'No se pudo guardar el archivo, verifique los tipos permitidos...',
                        })

                        $("#warning-alert-files").show('fast');
                        setTimeout(() => {
                            $("#warning-alert-files").hide('fast');
                        }, 8000);
                        $('#blah').attr('src', 'img/no_image_available.jpg'); 
                    }
                }
            }); 
        }
	});



	$("#eliminar").click(function(){
		var path =$("#pathSelected").val();
		var classes = $("#pathSelected").attr('class');
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
			  confirmButton: 'btn btn-success',
			  cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		  })
		  
		  swalWithBootstrapButtons.fire({
			title: '¿Estás segura(o) que desea borrar este archivo?',
			html: '<p class="font-weight-bolder" style="color: red !important;" >Esta acción no se puede corregir</p>',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, Borrar!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: false
		  }).then((result) => {
			if (result.value) {
				$.ajax({
					url: "Files/fileErase",
					type: "POST",
					data: {path:path, classes:classes},
					success:function(response){
						swalWithBootstrapButtons.fire(
							'Hecho!',
							'El archivo ha sido borrado.',
							'success'
						  )
						  setTimeout(() => {
							  location.reload('/files');
						  }, 1500);
					},
					error:function(){
						alert('error');
					}
				});

			} else if (
			  result.dismiss === Swal.DismissReason.cancel
			) {
			  swalWithBootstrapButtons.fire(
				'Cancelado',
				'La ación ha sido cancelada',
				'error'
			  )
			}
		  })

	});


	$("#mover").click(function(){
		alertify.error('La función de mover no ha sido implementada aún');
	});
	$("#renombrar").click(function(){
		$("#modalRenameFile").modal('show');
	});
	$("#copiar").click(function(){
		alertify.error('La función de copiar no ha sido implementada aún');
	});

	$("#btnRenameFile").click(function(){
		/*Hi, maybe you are wondering about my 'programing style' (on this function), but I didn't know another way for make it better
		  if you have a better way to do this code, go ahead, you're free for do it, THANKS*/

		var path = $("#pathSelected").val();
		var classes = $("#pathSelected").attr('class');
		var newNameFile = $("#newNameFile").val();
		var patt = new RegExp(/^[0-9a-zA-Z]+$/);
		var res = patt.test(newNameFile);
		if(res){
			var sizeString = path.length;
			var counter =  0;
			var typeFile='';
			var trigger;
			 for (i = sizeString; i>=0; i--){
				if(path.charAt(i)=='/'){
					counter++;
				}
				if(path.charAt(i)=='.'){
					trigger = i;
				}
			}
			var bandera = 0;
			var nameFile='';
			for (i = 0; i<sizeString; i++){
				if(bandera != counter){
					nameFile +=path.charAt(i);
				}
				if(path.charAt(i)== '/'){
					bandera++;
				}
				if(i>trigger){
					typeFile += path.charAt(i);
				}
			}
			$.ajax({
				url: 'Files/renameFile',
				type: 'POST',
				data: {nameFile:path,newNameFile:newNameFile,newPath:nameFile,typeFile:typeFile,classes:classes,}, 
				success:function(res){
					alertify.success(res);
					$("#modalRenameFile").modal('hide');
					setTimeout(() => {
						location.reload();
					}, 1500);
				},
				error:function(){
					
				}
			});
		}else{
			alertify.error('Error: El nuevo nombre no es valido. Verifique lo que ha escrito.');
		} 
	});

});

function checkNewNameFile(input){
	var str = input.value;
	var patt = new RegExp(/^[0-9a-zA-Z]+$/);
	var res = patt.test(str);
	if(res){
		$("#alertNewNameFile").hide('slow');
	}else{
		$("#alertNewNameFile").show('fast');
	}
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah')
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

function resetModalSubir(){
    setTimeout(() => {
        $("#finput").val('');
        $('#blah').attr('src', 'img/no_image_available.jpg');
    }, 1000);
}