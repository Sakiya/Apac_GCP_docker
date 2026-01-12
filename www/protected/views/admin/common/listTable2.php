<?php 
//新增 修改後返回使用
Yii::app()->user->returnUrl = Yii::app()->request->getUrl();
$controller = strtolower(Yii::app()->controller->id);

$Actionpermission = Yii::app()->user->getController();
?>
<div class="main-content-inner">	
	<div class="page-header col-lg-12">
		<h4><?=User::model()->getController();?></h4>
	</div> 
	<div class="breadcrumbs" id="breadcrumbs">
		<div class="breadcrumbsBox clearfix" id="">
			<div class="box pull-right">
				<?php if (array_search('adminadd',$Actionpermission)){?>
				<button type="" class="btn btn-success btn-lg" onclick="window.location.href='/<?php echo Yii::app()->controller->id;?>/adminadd'">新增</button>
				<?php }?>
			</div>
		</div>
		<div class="box pull-right " style="padding: 25px 0;">
			<form action="/zQam1/adminindex/">
				<label>顯示</label>
				<select id="dsp" name="dsp">
					<option value=""></option>
					<option value="1" <?=$_GET['dsp'] == '1' ? 'selected':'';?>>是</option>
					<option value="N" <?=$_GET['dsp'] == 'N' ? 'selected':'';?>>否</option>
				</select>
				<label>回覆</label>
				<select id="replay" name="replay">
					<option value=""></option>
					<option value="N" <?=$_GET['replay'] == 'N' ? 'selected':'';?>>否</option>
				</select>
				<input id="page" name="page" type="hidden" value="<?=$page;?>" >
				<button type="submit" class="btn btn-default">搜尋</button>
			</form>
		</div>
	</div>
	<div class="quoListBox col-lg-12 dataTables_wrapper form-inline no-footer">
		<table id="quoList" cellspacing="0" width="100%" class="table table-striped table-bordered table-hover dataTable no-footer" >
	        <thead>
		        <tr role="row">
				<?php
					foreach ($fields as $field){
				?>
					<th class="<?php echo $field['class'];?>" width="<?php echo $field['width'];?>" search="<?php echo $field['search'];?>">
						<?php 
							echo $field['name'];				
						?>
					</th>
				<?php        
				} 
				?>
			</thead>
			<tbody>
					<?php
					$colNum = count($fields);
					//資料回圈
					for ($r=0; $r<count($data); $r++){
						$class = ($r%2) ? "odd" : "";
						$row = ($data[$r]) ? $data[$r] : array();
					?>
						<tr class="table_row" onMouseOver="this.style.backgroundColor='#D8E8DC';" onMouseOut="this.style.backgroundColor='';">
							<?php
						    //表格欄位資料
						    for ($i=0; $i<$colNum; $i++){
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
		<div>
			<?php
				$this->widget('Pager_backend',array('pages'=>$pages));
			?>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
		/*
		var hasSearch = Array();
		$('#quoList thead th').each(function(){
			if ($(this).attr('search') == 1){
				hasSearch.push($(this).index('#quoList thead th'));
			}
			
		});
		*/
		var oTable = $('#quoList').DataTable( {
			"searching": false,
			"paging": false,
			"iDisplayLength" : 20,
			"oLanguage": {
			//"sSearch": "Filter Data"
			},
			/*
				        initComplete: function () {
				            this.api().columns(hasSearch).every( function () {
				                var column = this;
				                var select = $('<select><option value=""></option></select>')
				                    .appendTo( $(column.footer()).empty() )
				                    .on( 'change', function () {
				                        var val = $.fn.dataTable.util.escapeRegex(
				                            $(this).val()
				                        );
				 
				                        column
				                            .search( val ? '^'+val+'$' : '', true, false )
				                            .draw();
				                    } );
				 
				                column.data().unique().sort().each( function ( d, j ) {
					                if (d != ''){
				                    	select.append( '<option value="'+d+'">'+d+'</option>' );
				                    }
				                } );
				            } );
				        },
				        */
						
				    });
	});

	$(function(){
		$(".date-picker").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		});
		$(".date-picker1").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		});
	});
</script>