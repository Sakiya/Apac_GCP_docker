<!-- iOS Slider element with animateme scroll efect, custom height and bottom mask style 2 -->
		<div class="kl-slideshow iosslider-slideshow uh_light_gray maskcontainer--shadow_ud iosslider--custom-height scrollme">

			<!-- iOS Slider wrapper with animateme scroll efect -->
			<div class="iosSlider kl-slideshow-inner animateme" data-trans="6000" data-autoplay="1" data-infinite="true" data-when="span" data-from="0" data-to="0.75" data-translatey="300" data-easing="linear">
				<!-- Slides -->
				<div class="kl-iosslider hideControls">
					<!-- Slide 1 -->
				<?php 
					$i = 0;
					foreach ($Banner as $i => $row){
				?>
					<!-- Slide 1 -->
					<div class="item iosslider__item">
						<!-- Image -->
						<div class="slide-item-bg" for-id="blur-slider-<?=$i?>" for-images="<?=Yii::app()->params['customerfile']['Bannerm1_img'] . $row->bannerm1_img;?>" style="background-image:url(<?=Yii::app()->params['customerfile']['Bannerm1_img'] . $row->bannerm1_img;?>);">
						</div>
						<div class="slide-item-bg-blur" id="blur-slider-<?=$i?>"></div>
						<!-- Captions container -->
						<div class="container kl-iosslide-caption kl-ioscaption--style5 s4ext fromleft klios-alignleft kl-caption-posv-middle clearfix">
							<!-- Captions animateme wrapper -->
							<div class="animateme <?=Yii::app()->params['banner_stie'][$row->bannerm1_showtype];?>" data-when="span" data-from="0" data-to="0.75" data-opacity="0.1" data-easing="linear">
								<?php if ($row->bannerm1_title_en != ""){?>
								<!-- Main Big Title -->
								<h2 class="main_title has_titlebig underLine"><span><?=$row->bannerm1_title_en;?></span></h2>
								<?php }?>
								<?php if ($row->bannerm1_text_en != ""){?>
								<!--/ Main Big Title -->
								<h4 class="title_small"><div class="txtRange"><?=$row->bannerm1_text_en;?></div></h4>
								<?php }?>
							</div>
							<!--/ Captions animateme wrapper -->
						</div>
						<!--/ Captions container -->
					</div>
				<?php }?>
				</div>
				<!--/ Slides -->

				<!-- Navigation Controls - Prev -->
				<div class="kl-iosslider-prev">
					<span class="thin-arrows ta__prev"></span>
					<div class="btn-label">PREV</div>
				</div>
				<!--/ Navigation Controls - Prev -->

				<!-- Navigation Controls - Next -->
				<div class="kl-iosslider-next">
					<span class="thin-arrows ta__next"></span>
					<div class="btn-label">NEXT</div>
				</div>
			</div>

			<!-- Bullets -->
			<div class="kl-ios-selectors-block bullets2">
				<div class="selectors">
	                <?php for($i = 1 ; $i <= count($Banner); $i ++){?>
						<div class="item iosslider__bull-item <?=($i == 1 ? 'first' : '');?>"></div>
					<?php }?>
				</div>
			</div>
			<!--/ Bullets -->

			<div class="scrollbarContainer"></div>

			<!-- Bottom mask style 2 -->
			<div class="kl-bottommask kl-bottommask--shadow_ud"></div>
			<!--/ Bottom mask style 2 -->
		</div>
		<!--/ iOS Slider element with animateme scroll efect, custom height and bottom mask style 2 -->

		<!-- Action Box - Style 3 section with custom top padding and white background color -->
		<section class="hg_section bg-white ptop-0">
			<div class="container pushBox">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="action_box style3" data-arrowpos="center" style="margin-top:-25px;">
							<div class="action_box_inner">
								<div class="action_box_content">
									<div class="ac-content-text">
										<!-- Title -->
										<h1 class="text">Chi Hwa Advertising provides a complete package of professional and systematic services, from consulting, design, manufacture, assembly, packaging to shipment.</h1>
										<!--/ Title -->
									</div>

									<!-- Call to Action buttons -->
									<div class="ac-buttons">
										<a class="btn btn-lined ac-btn" href="<?php echo $this->createUrl('/contact/contact/',array('language'=>Yii::app()->language));?>" target="_blank">Contact Form</a>
										<a class="phoneBox" href="tel:03-5532151"><span class="pdR glyphicon glyphicon-earphone icon-white"></span>03 - 5532151</a>
									</div>
									<!--/ Call to Action buttons -->
								</div>
								<!--/ action_box_content -->
							</div>
							<!--/ action_box_inner -->
						</div>
						<!--/ action_box style3 -->
					</div>
					<!--/ col-md-12 col-sm-12 -->
				</div>
				<!--/ row -->
			</div>
			<!--/ container -->
		</section>
		<!--/ Action Box - Style 3 section with custom top padding and white background color -->


		<!-- Icon Box - Left Floated Style section -->
		<section class="hg_section bg-white">
			<div class="full_width">
				<div class="row">
					<div class="featureBox">
						<div class="row gutter-md">
							<div class="col-md-4 col-sm-4">
								<!-- Icon box float left -->
								<div class="kl-iconbox kl-iconbox--fleft text-left">
									<div class="kl-iconbox__inner">
										<!-- Icon -->
										<div class="kl-iconbox__icon-wrapper">
											<img class="kl-iconbox__icon" src="/main/images/icon_honest.png" alt="誠實穩健、踏實求進">
										</div>
										<!--/ Icon -->

										<!-- /.kl-iconbox__icon-wrapper -->
										<div class="kl-iconbox__content-wrapper">
											<!-- Title -->
											<div class="kl-iconbox__el-wrapper kl-iconbox__title-wrapper">
												<h3 class="kl-iconbox__title fw-normal dark-orang">Honest and Steady, Practical and Progress</h3>
											</div>
											<!--/ Title -->

											<!-- Description -->
											<div class=" kl-iconbox__el-wrapper kl-iconbox__desc-wrapper">
												<a href="about-company_EN_EN.html#philoso_1">
													<p class="kl-iconbox__desc gray">
														
														We, the CHI HWA ADVERTISING, began our business step by step on the basis of our honesty without any wheeling and dealing. We have always been keen to the learning...
													</p>
												</a>
											</div>
											<!--/ Description -->
										</div>
										<!-- /.kl-iconbox__content-wrapper -->
									</div>
									<!--/ kl-iconbox__inner -->
								</div>
								<!--/ Icon box float left -->
							</div>
							<!--/ col-md-3 col-sm-3 -->

							<div class="col-md-4 col-sm-4">
								<!-- Icon box float left -->
								<div class="kl-iconbox kl-iconbox--fleft text-left">
									<div class="kl-iconbox__inner">
										<!-- Icon -->
										<div class="kl-iconbox__icon-wrapper">
											<img class="kl-iconbox__icon" src="/main/images/icon_heart.png" alt="用心熱忱、服務至上">
										</div>
										<!--/ Icon -->

										<!-- /.kl-iconbox__icon-wrapper -->
										<div class="kl-iconbox__content-wrapper">
											<!-- Title -->
											<div class="kl-iconbox__el-wrapper kl-iconbox__title-wrapper">
												<h3 class="kl-iconbox__title fw-normal dark-orang"> Utmost Care, Service First</h3>
											</div>
											<!--/ Title -->

											<!-- Description -->
											<div class=" kl-iconbox__el-wrapper kl-iconbox__desc-wrapper">
												<a href="about-company_EN_EN.html#philoso_2">
													<p class="kl-iconbox__desc gray">
														With the progress of the times and technologies, we are confronted with a full spectrum of customer demands once we set up and developed our branches in science parks, industrial parks and the Industrial...
													</p>
												</a>
											</div>
											<!--/ Description -->
										</div>
										<!-- /.kl-iconbox__content-wrapper -->
									</div>
									<!--/ kl-iconbox__inner -->
								</div>
								<!-- Icon box float left -->
							</div>
							<!--/ col-md-3 col-sm-3 -->

							<div class="col-md-4 col-sm-4">
								<!-- Icon box float left -->
								<div class="kl-iconbox kl-iconbox--fleft text-left">
									<div class="kl-iconbox__inner">
										<!-- Icon -->
										<div class="kl-iconbox__icon-wrapper">
											<img class="kl-iconbox__icon" src="/main/images/icon_ppl.png" alt="同心事業、回饋社會">
										</div>
										<!--/ Icon -->

										<!-- /.kl-iconbox__icon-wrapper -->
										<div class="kl-iconbox__content-wrapper">
											<!-- Title -->
											<div class="kl-iconbox__el-wrapper kl-iconbox__title-wrapper">
												<h3 class="kl-iconbox__title fw-normal dark-orang">Concentric Business, Contribution to Society</h3>
											</div>
											<!--/ Title -->

											<!-- Description -->
											<div class="kl-iconbox__el-wrapper kl-iconbox__desc-wrapper">
												<a href="about-company_EN_EN.html#philoso_3">
													<p class="kl-iconbox__desc  gray">
														In CHI HWA, the dividend system of concentric business is applied to share the profits generated collectively by our employees. We also continue to enhance...
													</p>
												</a>
											</div>
											<!--/ Description -->
										</div>
										<!-- /.kl-iconbox__content-wrapper -->
									</div>
									<!--/ kl-iconbox__inner -->
								</div>
								<!--/ Icon box float left -->
							</div>
							<!--/ col-md-3 col-sm-3 -->
 
						
						</div>
						<!--/ row gutter-md -->
					</div>
					<!--/ col-sm-offset-1 col-md-10 col-sm-10 -->
				</div>
				<!--/ row -->
			</div>
			<!--/ full_width -->
		</section>
		<!--/ Icon Box - Left Floated Style section -->

		<!-- Image Boxes - Style 4 new section -->
		<section class="hg_section bg-lightgray ptop-50 productItem-BG">
			<div class="container large">
				<h3 class="title title-en dark-orang text-center">Solutions</h3>
				<div class="row">
				<?php foreach ($Pro as $row){
					if ($row->prot1_img1 != ''){
				?>
					<div class="col-md-4 col-sm-4">
						<!--/ Image Box style 4 - left symbol style -->
						<div class="box image-boxes imgboxes_style4 kl-title_style_left">
							<!-- Image Box anchor link -->
							<a class="imgboxes4_link imgboxes-wrapper" href="<?php echo $this->createUrl('/product/list/',array('language'=>Yii::app()->language)) . '#item'.$row->prot1_no;?>" target="_blank">
								<img src="<?=Yii::app()->params['customerfile']['Prot1_img1'] . $row->prot1_img1;?>" alt="<?=$row->prot1_title_en;?>" class="img-responsive imgbox_image cover-fit-img" />
								<span class="imgboxes-border-helper"></span>
								<h3 class="m_title imgboxes-title"><?=$row->prot1_title_en;?></h3>
							</a>
						</div>
					</div>
				<?php }
					}
				?>					
					<div class="col-md-4 col-sm-4">
						<div class="box image-boxes imgboxes_style4 kl-title_style_bottom">
							<div class="imgboxes4_link imgboxes-wrapper addStyle">
								<img src="/main/images/items/item6.jpg" alt="公司簡介型錄" title="公司簡介型錄" class="img-responsive imgbox_image cover-fit-img" />
								<div class="inboxWrap">
									<div class="boxL">
										<div class="intro">Product<br> Catalogue</div>
										<button onclick="window.open('/images/chi-hwa-advertising-catelog.pdf')">VIEW</button>
									</div>
								</div>
								<span class="imgboxes-border-helper"></span>
							</div>
						</div>
					</div>
					<!--/ col-md-4 col-sm-4  -->

				</div>
			</div>
		</section>
		<!--/ Image Boxes - Style 4 new section -->
		<?php if (count($News) > 0){?>
		<!-- Hover Boxes section whith custom top padding -->
		<section class="hg_section ptop-50 pbottom-70 bg-white">
			<div class="container large">
				<h3 class="title title-en dark-orang text-center">NEWS</h3>
				<div class="row flexBox-top">
                <?php foreach ($News as $row){?>
					<div class="col-md-4 col-sm-12">
						<!-- Hover box element -->
						<div class="newsItem">
							<!-- Link box with background color -->
							<a href="<?php echo $this->createUrl('/news/index/',array('language'=>Yii::app()->language)) . '#item'.$row->newsm1_no;?>" style="background-color: transparent;" class="hover-box hover-box-2">
								<h3><?=$row->newsm1_title_en;?></h3>
								<span class="tabelcell first">
									<p>
										<span class="listT"><?=mb_substr(strip_tags($row->newsm1_content_en),0,($row->newsm1_img != "" ? 50 : 84),"utf-8");?>...</span>
									</p>
								</span>
								<?php if ($row->newsm1_img != ''){?>
								<span class="tabelcell">
									<span class="newsImgBox"><img src="<?=Yii::app()->params['customerfile']['Newsm1_img'] . $row->newsm1_img;?>" alt=""></span>
								</span>
								<?php }?>
							</a>
						</div>
					</div>
				<?php }?>
				</div>
			</div>
		</section>
		<!--/ Hover Boxes section whith custom top padding -->
		<?php }?>
	<?php
	Yii::app()->clientScript->registerScript('search', "
			$('.slide-item-bg').each(function(){
				var _id = $(this).attr('for-id');
				$('#' + _id).backgroundBlur({
				    imageURL : $(this).attr('for-images'),
				    blurAmount : 20,
				    imageClass : 'bg-blur'
				});
			})
	
	");
	?>
