        <!--menu-->
		<?php $this->renderPartial('/layouts/menu_member'); ?> 
        <!--內文-->
        <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">Email Validation</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3>Dear <?=$model->name_en;?></h3>
                            <div class="discription">Thank you for registering with ONE ART Taipei. A confirmation e-mail has been sent to you. Please click on the link in the email in order to complete your registration.</div>
                            <div class="discription">Regards,<br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> Committee</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>