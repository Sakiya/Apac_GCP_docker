<?php 
//新增 修改後返回使用
Yii::app()->user->returnUrl = Yii::app()->request->getUrl();
$controller = strtolower(Yii::app()->controller->id);

$Actionpermission = Yii::app()->user->getController();

?>
<div class="main-content-inner">
	<div class="page-header">
		<div class=" col-lg-6 col-lm-6">
			<h4><?=User::model()->getController();?></h4>
			<?php if ($controller == 'zprom1'){?>
			<h6 style="color: #a29999;font-size:15px;">請先從類別下拉選單選擇一類別，再手動排序</h6>
			<?php }?>
		</div> 
		<div class="breadcrumbs col-lg-6 col-lm-6" id="breadcrumbs">
			<div class="breadcrumbsBox clearfix" id="">
				<div class="box pull-right">
					<?php if (array_search('adminadd',$Actionpermission)){?>
					<button type="" class="btn btn-success btn-lg" onclick="window.location.href='/<?php echo Yii::app()->controller->id;?>/adminadd'">新增</button>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<div class="quoListBox col-lg-12 dataTables_wrapper form-inline no-footer">
		<table id="quoList" cellspacing="0" width="100%" class="table table-striped table-bordered table-hover dataTable no-footer" >
	        <thead>
		        <tr role="row">
				<?php
					$sort = 0;
					foreach ($fields as $field){
						if ($sort > 0){
				?>
					<th class="<?php echo $field['class'];?>" width="<?php echo $field['width'];?>" search="<?php echo $field['search'];?>">
						<?php 
							echo $field['name'];				
						?>
					</th>
				<?php   
					}
					$sort ++;  
				} 
				?>
		        </tr>
	            <tr>
		        <?php
					$sort = 0;
					foreach ($fields as $field){
						if ($sort > 0){
				?>
	                <td class="<?php echo $field['class'];?>" align="<?php echo $field['align'];?>" defaultsearch=<?=(isset($field['defaultsearch']) ? $field['defaultsearch'] : false)?>></td>
				<?php 
					}
					$sort ++;  
					}
				?>
	            </tr>
			</thead>
			<tbody id="<?=($CanSort == '1' ? 'sortable':'');?>">
					<?php
					$colNum = count($fields);
					//資料回圈
					for ($r=0; $r<count($data); $r++){
						$class = ($r%2) ? "odd" : "";
						$row = ($data[$r]) ? $data[$r] : array();
					?>
						<tr id="<?=$row[0];?>" class="table_row" onMouseOver="this.style.backgroundColor='#D8E8DC';" onMouseOut="this.style.backgroundColor='';">
							<?php
						    //表格欄位資料
						    for ($i=1; $i<$colNum; $i++){
							?>
						          <td width="" class="<?php echo $fields[$i]['class'];?>" align="<?php echo $fields[$i]['align'];?>" <?php //echo $PAGE_SIZE;?>> <?php echo $row[$i]; ?> </td>
							<?php
						    }
							?>
						</tr>
					<?php
					}
					?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {		
		var hasSearch = Array();
/*
		$('#quoList thead  th').each(function(){
			if ($(this).attr('search') == 1){
				hasSearch.push($(this).index('#quoList thead th'));
			}
			
		});
*/
		$('#quoList thead th').each(function(){
			if ($(this).attr('search') == 1){
				hasSearch.push($(this).index('#quoList thead th'));
			}
			
		});
	    var oTable = $('#quoList').DataTable( {
		    "iDisplayLength" : 20,
		    "oLanguage": {
		      "sSearch": "篩選資料:"
		    },
	        initComplete: function () {
	            this.api().columns(hasSearch).every( function () {
	                var column = this;
					var lastCat = '';
	                var defaultsearch = $(column.header()).attr('defaultsearch');
	                var select = $('<select>' + (defaultsearch == '1' ? '' : '<option value="">全部</option>') + '</select>')
	                    .appendTo( $(column.header()).empty() )
	                    .on( 'change', function () {
	                        var val = $.fn.dataTable.util.escapeRegex(
	                            $(this).val()
	                        );

	                        column
	                            .search( val ? '^'+val+'$' : '', true, false )
	                            .draw();

	                    });
	                column.data().unique().sort().each( function ( d, j ) {
		                //lastCat = "壓克力加工訂製服務";
		                if (lastCat == "" & defaultsearch != ""){
			                lastCat = d;
		                }
		                if(lastCat === d) {
		                    select.append( '<option SELECTED value="'+d+'">'+d+'</option>' )
		                } else {
		                    select.append( '<option value="'+d+'">'+d+'</option>' )
		                }
		                /*
		                if (d != ''){
	                    	select.append( '<option value="'+d+'">'+d+'</option>' );
	                    }
	                    */
	                });
	                if (lastCat != ""){
						column.search(lastCat).draw();
					}
					/*
		            $(oTable).ready(function() {
			        	column.search( lastCat ? '^'+lastCat+'$' : '', true, false ).draw();
			        });	
			        */
	            });
	        },
			"pagingType": 'simple_numbers'
	    });
/*
var lastCat = 'the category';
var table = $('#Products').DataTable({
    "iDisplayLength": 40,
    initComplete: function () {
        this.api().columns('3').every( function () {
            var column = this;
            var select = $('<select><option value="">All Categories</option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
 
            column.data().unique().sort().each( function ( d, j ) {
                if(lastCat === d) {
                    select.append( '<option SELECTED value="'+d+'">'+d+'</option>' )
                } else {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                }
            } );
            $(table).ready(function() {
        column.search( lastCat ? '^'+lastCat+'$' : '', true, false ).draw();
        });
        } );
    }
});
*/
		$( "#sortable" ).sortable({
			update: function (event, ui) {
				var sortedIds = $("#sortable").sortable("toArray").toString();
				//console.log(sortedIds);
				//console.log($(this).sortable('toArray'));
				$.post("/<?php echo Yii::app()->controller->id;?>/Adminchangeorder", $.param({ ids: sortedIds , YII_CSRF_TOKEN: '<?=Yii::app()->request->csrfToken?>'}, true))
				.done(function (data) {
					console.log(data);
				}).fail(function () {
					$("#error-message").show().delay(800).fadeOut("slow");
				});
			}
		});
	});
</script>