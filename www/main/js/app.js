$(document).ready(function() {
    $(".zh .fa-user-plus").click(function() {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp">         <div class="container">           <h3 style="margin-bottom:30px; margin-top: 20px;">您還要繼續新增其他藝術家嗎？</h3>           <div class="btn-green-border pull-left popUp-cancel">             <h5>取消</h5>           </div>           <div class="btn-green pull-right" onclick="addart();"><h5> 新增其他藝術家</h5></div></div>       </div></div>');
    });
    $(".en .fa-user-plus").click(function() {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3 style="margin-bottom:30px; margin-top: 20px;">Would you like to add more participating artists?</h3><div class="btn-green-border pull-left popUp-cancel"><h5>No, I\'m done</h5></div><div class="btn-green pull-right" onclick="addart();"><h5> Yes, I want to add more.</h5></div></div></div></div>');
    });
});
$(document).ready(function() {
    $(".greenbox").on("change", ".onlyOne-check",
    function() {
        $(".onlyOne-check").not(this).prop("checked", !1);
    });
});
$(document).ready(function() {
    function e() {
		$("body").append("<div class='popUp'><div class='whiteScreen'></div><div class='white-popUp'><div class='container' style='width:510px;line-height:33px'><h3>請問貴畫廊的所在位置? <br>Where is the location of your art gallery?</h3><a class='OverseasGallery btn-green-border pull-left' style='width:260px;margin-top: 7px;' href='/en/Member/join/'>                         <h5>Non-Taiwanese Gallery</h5>                     </a>                    <a href='/zh/Member/join/' class='TaiwanGallery btn-green pull-right' style='width:245px;margin-top: 7px;'>                         <h5> 台灣地區畫廊</h5>                    </a>                 </div>             </div>         </div>");
    }
    $(".signUp").click(function() {
        e();
    });
    $("body").on("click", ".whiteScreen,.popUp-cancel",
    function() {
        $(".popUp").fadeOut();
    });
});
$(document).ready(function() {
    function e_en() {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3>Reset Password</h3><form id="form-pwd"><input id="oldpwd" type="password" placeholder="Please type in your current password " class="form"/><input id="newpwd" type="password" placeholder="Please type in your new password(Minimum 4 words)" class="form"/><input id="confirmpwd" type="password" placeholder="Please re-type in your new password" class="form"/><div class="btn-green-border pull-left popUp-cancel"><h5>Cancel</h5></div><div class="btn-green pull-right " onclick="checksubmit();"><h5> Send</h5></div></form></div></div></div>');
    }
    function e_zh() {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3>修改登入密碼</h3><form id="form-pwd"><input id="oldpwd" type="password" placeholder="輸入舊密碼" class="form"/><input id="newpwd" type="password" placeholder="輸入新密碼(至少4碼)" class="form"/><input id="confirmpwd" type="password" placeholder="再次輸入新密碼" class="form"/><div class="btn-green-border pull-left popUp-cancel"><h5>取消</h5></div><div class="btn-green pull-right " onclick="checksubmit();"><h5> 確認</h5></div></form></div></div></div>');
    }
    function i_en() {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3>Cancel Application</h3><form id="form-cancel"><input id="cacnelpwd" type="password" placeholder="Please type in your current password " class="form"/><div class="btn-green-border pull-left popUp-cancel"><h5>Cancel</h5></div><button class="btn-green pull-right" type="button" onclick="cancelsubmit();"><h5> Send</h5></button></form></div></div></div>');
    }
    function i_zh() {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3>是否取消參與活動？</h3><form id="form-cancel"><input id="cacnelpwd" type="password" placeholder="請輸入登入密碼" class="form"/><div class="btn-green-border pull-left popUp-cancel"><h5>取消</h5></div><button class="btn-green pull-right" type="button" onclick="cancelsubmit();"><h5> 確認</h5></button></form></div></div></div>');
    }

    function s_zh(id,name) {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3 style="margin-bottom:30px ;margin-top: 20px;">是否刪除' + name + '藝術家資料？</h3><div class="btn-green-border pull-left popUp-cancel"><h5>取消</h5> </div> <div class="btn-green pull-right" onclick="deleteart(' +  id + ')"><h5> 確認</h5></div></div></div></div>');
    }
    function s_en(id,name) {
        $("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3 style="margin-bottom:30px ;margin-top: 20px;">Would you like to delete the information of ' + name + '</h3><div class="btn-green-border pull-left popUp-cancel"><h5>Cancel</h5> </div> <div class="btn-green pull-right" onclick="deleteart(' +  id + ')"><h5> Send</h5></div></div></div></div>');
    }
    $("body.en .changePassword").click(function() {
        e_en();
    });
    $("body.zh .changePassword").click(function() {
        e_zh();
    });
    $("body.en .cancleRegistret").click(function() {
        i_en();
    });
    $("body.zh .cancleRegistret").click(function() {
        i_zh();
    });
    $("body.zh .deleteArticle").click(function(event) {
        event.preventDefault();
        s_zh($(this).attr('id'),$(this).attr('name'));
    });
    $("body.en .deleteArticle").click(function(event) {
        event.preventDefault();
        s_en($(this).attr('id'),$(this).attr('name'));
    });
    $("#menu-apply li").mouseenter(function() {
        if (!$(this).hasClass("active")) {
            $(this).find(".fa-check").removeClass("fa-check").addClass("fa-pencil");
        }
    });
    $("#menu-apply li").mouseleave(function() {
        if (!$(this).hasClass("active")) {
            $(this).find(".fa-pencil").removeClass("fa-pencil").addClass("fa-check");
        }
    });
});
function updateImagePreviews() {
    $.each($(".img-wrapper img"), function(index, imgElement) {
        const srcUrl = $(imgElement).attr("src");
        $(imgElement).parent().css("background", "url(" + srcUrl + ") no-repeat center center").css("background-size", "cover");
        $(imgElement).remove();
    });
}

$(document).ready(function(){
    const currentYear = (new Date()).getFullYear();
    for (let y = currentYear; y > 1900; y--) {
        $(".yearpicker,.yearpicker2").append("<option>"+y+"</option>");
    }
    const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    for (let i = 0; i < months.length; i++) {
        $(".monthsPicker").append("<option>"+months[i]+"</option>");
    }
    const countries = [{name:"Afghanistan",code:"AF"},{name:"Åland Islands",code:"AX"},{name:"Albania",code:"AL"},{name:"Algeria",code:"DZ"},{name:"American Samoa",code:"AS"},{name:"AndorrA",code:"AD"},{name:"Angola",code:"AO"},{name:"Anguilla",code:"AI"},{name:"Antarctica",code:"AQ"},{name:"Antigua and Barbuda",code:"AG"},{name:"Argentina",code:"AR"},{name:"Armenia",code:"AM"},{name:"Aruba",code:"AW"},{name:"Australia",code:"AU"},{name:"Austria",code:"AT"},{name:"Azerbaijan",code:"AZ"},{name:"Bahamas",code:"BS"},{name:"Bahrain",code:"BH"},{name:"Bangladesh",code:"BD"},{name:"Barbados",code:"BB"},{name:"Belarus",code:"BY"},{name:"Belgium",code:"BE"},{name:"Belize",code:"BZ"},{name:"Benin",code:"BJ"},{name:"Bermuda",code:"BM"},{name:"Bhutan",code:"BT"},{name:"Bolivia",code:"BO"},{name:"Bosnia and Herzegovina",code:"BA"},{name:"Botswana",code:"BW"},{name:"Bouvet Island",code:"BV"},{name:"Brazil",code:"BR"},{name:"British Indian Ocean Territory",code:"IO"},{name:"Brunei Darussalam",code:"BN"},{name:"Bulgaria",code:"BG"},{name:"Burkina Faso",code:"BF"},{name:"Burundi",code:"BI"},{name:"Cambodia",code:"KH"},{name:"Cameroon",code:"CM"},{name:"Canada",code:"CA"},{name:"Cape Verde",code:"CV"},{name:"Cayman Islands",code:"KY"},{name:"Central African Republic",code:"CF"},{name:"Chad",code:"TD"},{name:"Chile",code:"CL"},{name:"China",code:"CN"},{name:"Christmas Island",code:"CX"},{name:"Cocos (Keeling) Islands",code:"CC"},{name:"Colombia",code:"CO"},{name:"Comoros",code:"KM"},{name:"Congo",code:"CG"},{name:"Congo, The Democratic Republic of the",code:"CD"},{name:"Cook Islands",code:"CK"},{name:"Costa Rica",code:"CR"},{name:"Cote D'Ivoire",code:"CI"},{name:"Croatia",code:"HR"},{name:"Cuba",code:"CU"},{name:"Cyprus",code:"CY"},{name:"Czech Republic",code:"CZ"},{name:"Denmark",code:"DK"},{name:"Djibouti",code:"DJ"},{name:"Dominica",code:"DM"},{name:"Dominican Republic",code:"DO"},{name:"Ecuador",code:"EC"},{name:"Egypt",code:"EG"},{name:"El Salvador",code:"SV"},{name:"Equatorial Guinea",code:"GQ"},{name:"Eritrea",code:"ER"},{name:"Estonia",code:"EE"},{name:"Ethiopia",code:"ET"},{name:"Falkland Islands (Malvinas)",code:"FK"},{name:"Faroe Islands",code:"FO"},{name:"Fiji",code:"FJ"},{name:"Finland",code:"FI"},{name:"France",code:"FR"},{name:"French Guiana",code:"GF"},{name:"French Polynesia",code:"PF"},{name:"French Southern Territories",code:"TF"},{name:"Gabon",code:"GA"},{name:"Gambia",code:"GM"},{name:"Georgia",code:"GE"},{name:"Germany",code:"DE"},{name:"Ghana",code:"GH"},{name:"Gibraltar",code:"GI"},{name:"Greece",code:"GR"},{name:"Greenland",code:"GL"},{name:"Grenada",code:"GD"},{name:"Guadeloupe",code:"GP"},{name:"Guam",code:"GU"},{name:"Guatemala",code:"GT"},{name:"Guernsey",code:"GG"},{name:"Guinea",code:"GN"},{name:"Guinea-Bissau",code:"GW"},{name:"Guyana",code:"GY"},{name:"Haiti",code:"HT"},{name:"Heard Island and Mcdonald Islands",code:"HM"},{name:"Holy See (Vatican City State)",code:"VA"},{name:"Honduras",code:"HN"},{name:"Hong Kong",code:"HK"},{name:"Hungary",code:"HU"},{name:"Iceland",code:"IS"},{name:"India",code:"IN"},{name:"Indonesia",code:"ID"},{name:"Iran, Islamic Republic Of",code:"IR"},{name:"Iraq",code:"IQ"},{name:"Ireland",code:"IE"},{name:"Isle of Man",code:"IM"},{name:"Israel",code:"IL"},{name:"Italy",code:"IT"},{name:"Jamaica",code:"JM"},{name:"Japan",code:"JP"},{name:"Jersey",code:"JE"},{name:"Jordan",code:"JO"},{name:"Kazakhstan",code:"KZ"},{name:"Kenya",code:"KE"},{name:"Kiribati",code:"KI"},{name:"Korea, Democratic People'S Republic of",code:"KP"},{name:"Korea, Republic of",code:"KR"},{name:"Kuwait",code:"KW"},{name:"Kyrgyzstan",code:"KG"},{name:"Lao People'S Democratic Republic",code:"LA"},{name:"Latvia",code:"LV"},{name:"Lebanon",code:"LB"},{name:"Lesotho",code:"LS"},{name:"Liberia",code:"LR"},{name:"Libyan Arab Jamahiriya",code:"LY"},{name:"Liechtenstein",code:"LI"},{name:"Lithuania",code:"LT"},{name:"Luxembourg",code:"LU"},{name:"Macao",code:"MO"},{name:"Macedonia, The Former Yugoslav Republic of",code:"MK"},{name:"Madagascar",code:"MG"},{name:"Malawi",code:"MW"},{name:"Malaysia",code:"MY"},{name:"Maldives",code:"MV"},{name:"Mali",code:"ML"},{name:"Malta",code:"MT"},{name:"Marshall Islands",code:"MH"},{name:"Martinique",code:"MQ"},{name:"Mauritania",code:"MR"},{name:"Mauritius",code:"MU"},{name:"Mayotte",code:"YT"},{name:"Mexico",code:"MX"},{name:"Micronesia, Federated States of",code:"FM"},{name:"Moldova, Republic of",code:"MD"},{name:"Monaco",code:"MC"},{name:"Mongolia",code:"MN"},{name:"Montserrat",code:"MS"},{name:"Morocco",code:"MA"},{name:"Mozambique",code:"MZ"},{name:"Myanmar",code:"MM"},{name:"Namibia",code:"NA"},{name:"Nauru",code:"NR"},{name:"Nepal",code:"NP"},{name:"Netherlands",code:"NL"},{name:"Netherlands Antilles",code:"AN"},{name:"New Caledonia",code:"NC"},{name:"New Zealand",code:"NZ"},{name:"Nicaragua",code:"NI"},{name:"Niger",code:"NE"},{name:"Nigeria",code:"NG"},{name:"Niue",code:"NU"},{name:"Norfolk Island",code:"NF"},{name:"Northern Mariana Islands",code:"MP"},{name:"Norway",code:"NO"},{name:"Oman",code:"OM"},{name:"Pakistan",code:"PK"},{name:"Palau",code:"PW"},{name:"Palestinian Territory, Occupied",code:"PS"},{name:"Panama",code:"PA"},{name:"Papua New Guinea",code:"PG"},{name:"Paraguay",code:"PY"},{name:"Peru",code:"PE"},{name:"Philippines",code:"PH"},{name:"Pitcairn",code:"PN"},{name:"Poland",code:"PL"},{name:"Portugal",code:"PT"},{name:"Puerto Rico",code:"PR"},{name:"Qatar",code:"QA"},{name:"Reunion",code:"RE"},{name:"Romania",code:"RO"},{name:"Russian Federation",code:"RU"},{name:"RWANDA",code:"RW"},{name:"Saint Helena",code:"SH"},{name:"Saint Kitts and Nevis",code:"KN"},{name:"Saint Lucia",code:"LC"},{name:"Saint Pierre and Miquelon",code:"PM"},{name:"Saint Vincent and the Grenadines",code:"VC"},{name:"Samoa",code:"WS"},{name:"San Marino",code:"SM"},{name:"Sao Tome and Principe",code:"ST"},{name:"Saudi Arabia",code:"SA"},{name:"Senegal",code:"SN"},{name:"Serbia and Montenegro",code:"CS"},{name:"Seychelles",code:"SC"},{name:"Sierra Leone",code:"SL"},{name:"Singapore",code:"SG"},{name:"Slovakia",code:"SK"},{name:"Slovenia",code:"SI"},{name:"Solomon Islands",code:"SB"},{name:"Somalia",code:"SO"},{name:"South Africa",code:"ZA"},{name:"South Georgia and the South Sandwich Islands",code:"GS"},{name:"Spain",code:"ES"},{name:"Sri Lanka",code:"LK"},{name:"Sudan",code:"SD"},{name:"Suriname",code:"SR"},{name:"Svalbard and Jan Mayen",code:"SJ"},{name:"Swaziland",code:"SZ"},{name:"Sweden",code:"SE"},{name:"Switzerland",code:"CH"},{name:"Syrian Arab Republic",code:"SY"},{name:"Taiwan",code:"TW"},{name:"Tajikistan",code:"TJ"},{name:"Tanzania, United Republic of",code:"TZ"},{name:"Thailand",code:"TH"},{name:"Timor-Leste",code:"TL"},{name:"Togo",code:"TG"},{name:"Tokelau",code:"TK"},{name:"Tonga",code:"TO"},{name:"Trinidad and Tobago",code:"TT"},{name:"Tunisia",code:"TN"},{name:"Turkey",code:"TR"},{name:"Turkmenistan",code:"TM"},{name:"Turks and Caicos Islands",code:"TC"},{name:"Tuvalu",code:"TV"},{name:"Uganda",code:"UG"},{name:"Ukraine",code:"UA"},{name:"United Arab Emirates",code:"AE"},{name:"United Kingdom",code:"GB"},{name:"United States",code:"US"},{name:"United States Minor Outlying Islands",code:"UM"},{name:"Uruguay",code:"UY"},{name:"Uzbekistan",code:"UZ"},{name:"Vanuatu",code:"VU"},{name:"Venezuela",code:"VE"},{name:"Viet Nam",code:"VN"},{name:"Virgin Islands, British",code:"VG"},{name:"Virgin Islands, U.S.",code:"VI"},{name:"Wallis and Futuna",code:"WF"},{name:"Western Sahara",code:"EH"},{name:"Yemen",code:"YE"},{name:"Zambia",code:"ZM"},{name:"Zimbabwe",code:"ZW"}];
    for (let i = 0; i < countries.length; i++) {
        $(".countrySelector").append("<option>"+countries[i].name+"</option>");
    }
});
$(document).ready(function() {
    $(function() {
        dropifyFiles();
    });
});
$(".delete-img").hide();
$(".zh .delete-img").click(function() {
    $(this).parents(".upload").siblings().css("background-image", "").siblings().attr("value", "");
    $(this).siblings().find(".file-upload-text").text("上傳照片");
    $(this).hide();
});
$(".en .delete-img").click(function() {
    $(this).parents(".upload").siblings().css("background-image", "").siblings().attr("value", "");
    $(this).siblings().find(".file-upload-text").text("Upload Image");
    $(this).hide();
});
function dropifyFiles(){
    const handler = {
        init: function() {
            handler.setPreviewImg();
            handler.listenInput();
        },
        setPreviewImg: function(inputElement) {
            let inputVal = $(inputElement).val();
            if (inputVal) {
                const fileName = inputVal.replace(/^C:\\fakepath\\/, "");
                const textSelector = $(inputElement).siblings(".file-upload-text");
                handler.showPreview(inputElement, fileName, textSelector);
            }
        },
        showPreview: function(inputElement, fileName, textSelector) {
            const files = $(inputElement)[0].files;
            if (files?.[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewContainer = $(inputElement).parents(".upload").siblings(".preview");
                    const imgElement = $(previewContainer).find("img");
                    if (imgElement.length === 0) {
                        $(previewContainer).html('<img src="' + event.target.result + '" alt=""/>');
                    } else {
                        imgElement.attr("src", event.target.result);
                    }
                    textSelector.val(fileName);
                    updateImagePreviews();
                };
                reader.readAsDataURL(files[0]);
            }
        },
        listenInput: function() {
            $(".zh .file-upload-native").on("change", function() {
                const fileSizeMb = this.files[0].size / 1024 / 1024;
                const fileType = this.files[0].type;
                if (fileSizeMb <= 1 && (fileType === 'image/jpg' || fileType === 'image/jpeg' || fileType === 'image/png')){
                    handler.setPreviewImg(this);
                    $(this).siblings(".file-upload-text").text("重新上傳照片");
                    $(this).parents(".upload").find(".delete-img").show();
                }
            });
            $(".en .file-upload-native").on("change", function() {
                const fileSizeMb = this.files[0].size / 1024 / 1024;
                const fileType = this.files[0].type;
                if (fileSizeMb <= 1 && (fileType === 'image/jpg' || fileType === 'image/jpeg' || fileType === 'image/png')){
                    handler.setPreviewImg(this);
                    $(this).siblings(".file-upload-text").text("Change Image");
                    $(this).parents(".upload").find(".delete-img").show();
                }
            });
        }

    };
    handler.init();
}