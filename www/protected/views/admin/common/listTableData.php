					<?php
					$colNum = count($fields);
					print_r($colNum);
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