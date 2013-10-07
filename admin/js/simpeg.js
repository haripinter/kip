$(document).ready(function(){
	//disbaling some functions for Internet Explorer
	//if($.browser.msie)
	//{
	//	//$('#is-ajax').prop('checked',false);
	//	//$('#for-is-ajax').hide();
	//	//$('#toggle-fullscreen').hide();
	//	//$('.login-box').find('.input-large').removeClass('span10');
	//	
	//}
	
	//highlight current / active link
	$('ul.main-menu li a').each(function(){
		if($($(this))[0].href==String(window.location))
			$(this).parent().addClass('active');
	});
	
	//ajaxify menus
	$('a.ajax-link').click(function(e){
		//if($.browser.msie){
		//e.which=1;
		//console.log($.browser.msie)
		//}
		//if(e.which!=1 || $(this).parent().hasClass('active')) return;
		if(e.preventDefault()) e.preventDefault = false;
		//alert(navigator.userAgent)
		//if($('.btn-navbar').is(':visible'))
		//{
		//	$('.btn-navbar').click();
		//}
		//$('#loading').remove();
		//$('#content').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');
		var $clink=$(this);
		////History.pushState(null, null, clink.attr('href'));
		$('ul.main-menu li.active').removeClass('active');
		$clink.parent('li').addClass('active');	
		////alert(clink.attr('href'))
		
		var url = $clink.attr('name');
		var posting = $.post(url);
		posting.done(function(data){
			//var res = $.parseJSON(data);
			var res = data;
			var content = $("#content");
			content.html(res);
			//$('.datepicker').datepicker();
			//$('.cleditor').cleditor();
			//if(res['status']=='error'){
			//	//content.addClass("alert alert-error");
			//}else if(res['status']=='success'){
			//	//content.addClass("alert alert-success");
			//	//$('#loading').remove();
			//	content.html(res);
			//}else{
			//	content.addClass("alert alert-error");
			//	content[0].innerHTML = 'Something error with your sintax! :)';
			//}
		});
	});
	
	//animating menus on hover
	$('ul.main-menu li:not(.nav-header)').hover(function(){
		$(this).animate({'margin-left':'+=5'},300);
	},
	function(){
		$(this).animate({'margin-left':'-=5'},300);
	});
	
	//$(document).ready(function(){
		$('.datepicker').datepicker();
		$('.cleditor').cleditor();
	//});


	//datatable
	$('.datatable').dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ Tampilan Perhalaman",
			}
		} );

});

//additional functions for data table
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings ){
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
}

$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
});