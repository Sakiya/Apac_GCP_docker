<html>

<head>
    <style type="text/css">
        /* reset */
        
        body,
        table,
        tr,
        td,
        p,
        ul,
        li,
        h1,
        h2,
        h3,
        img {
            margin: 0;
            padding: 0;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            border: 0px solid #000;
        }
        
        #page {
            display: block;
            width: 1024px;
            height: 700px;
            margin-bottom: 5px;
            /* background-color: rgb(172, 172, 172); */
        }
        
        table {
            border: 0px solid #000;
        }
        /* 可被共用元件 */
        
        .lil {
            text-align: right;
            padding-right: 10px;
            font-weight: 500px;
            width: 70px;
            font-size: 14px;
            vertical-align: top;
        }
        
        .lir {
            text-align: left;
            font-weight: 100px;
            font-size: 14px;
            color: #666;
            line-height: 20px
        }
        
        .lir br {
            display: block;
        }
        
        .bdr1px {
            border-right: 1px solid #000;
        }
        
        .bdb1px {
            border-bottom: 1px solid #000;
        }
        /* Page1、2、3 head_title */
        
        .titlebox {
            width: 1024px;
            border-bottom: 2px solid #000;
            padding: 3px 0px;
            font-size: 30px;
        }
        
        .titlebox .year_Local td {
            padding-right: 5px;
        }
        /* Page1 畫廊基本資料、2016、2017聯展經歷 */
        
        .info1 {
            padding: 5px 0px;
            height: 320px;
        }
        
        .info1 table td {
            padding-top: 0px;
            padding-bottom: 2px;
        }
        /* Page1 參展經歷 */
        
        .history {
            padding-top: 5px;
            font-size: 14px;
        }
        
        .history .date {
            color: #666;
            font-size: 14px;
        }
        /* Page2 房型方案選擇 */
        
        .room {
            padding-left: 30px;
            padding-top: 10px;
        }
        
        .room ul {
            padding: 0 0 20px 0;
        }
        
        .room h1 {
            font-size: 18px;
            margin: 0 0 5px 0;
        }
        
        .room h2 {
            font-size: 16px;
            margin: 0 0 5px 0px;
        }
        
        .room li {
            margin: 0 0 5px 3px;
            font-size: 16px;
            list-style-type: none;
        }
        
        .room span {
            display: inline-block;
            border-radius: 20px;
            width: 16px;
            height: 16px;
            background-color: #000;
            padding: 2px;
            color: #fff;
            margin-right: 5px;
            text-align: center;
            font-size: 14px;
        }
        /* Page2 策展理念 */
        
        .topics {
            padding-right: 30px;
            padding-top: 10px
        }
        
        .info2 {
            height: 610px;
        }
        
        .info2 .topics .lir_title {
            font-size: 18px;
            color: #000;
            height: auto;
            padding-bottom: 10px
        }
        
        .info2 .topics .lir {
            line-height: 22px;
            text-indent: 14px;
        }
        
        .info2 .topics .lil {
            font-size: 16px;
            padding-left: 20px;
        }
        
        .info2 .topics .lir br {
            content: "";
            margin: 2em;
            display: block;
            font-size: 24%;
        }
        /* Page3展覽經歷*/
        
        .exp {
            font-size: 12px;
            height: 200px
        }
        
        .exp table {
            width: 320px;
            color: #000;
        }
        
        .exp .title {
            font-size: 16px;
            display: block;
            padding-bottom: 5px;
            padding-top: 10px;
        }
        
        .exp .list p {
            font-size: 14px;
            margin: 0;
            padding: 0px 10px 0 0;
            line-height: 22px
        }
        /* Page3作品展示說明 */
        
        .work {
            font-size: 14px;
        }
        
        .work .image {
            display: inline-block;
            width: 230px;
            height: 230px;
            margin: 0 5px 0 0;
            background: no-repeat left bottom;
            background-size: contain
        }
        
        .work .image img {
            width: auto;
            /* height: auto; */
            min-height: 60%;
            min-width: 60%;
            /* max-width: 90%; */
        }
        
        .work .work-info {
            font-size: 12px;
            width: 320px;
        }
        
        .work .work-info .image {
            background-color: #fff;
            background: center no-repeat bottom;
            background-size: contain;
            width: 320px;
            height: 320px;
        }
        
        .work .work-info .name {
            color: #000
        }
        
        .work .work-info .year,
        .size,
        .material {
            color: #666;
        }
    </style>
</head>

<body>
    <!-- 畫廊簡介 -->
    <div id="page">
        <table width="1024" border="0">
            <thead>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td>晴山藝術中心&nbsp;Aki Gallery</td>
                        <td style="text-align: right;font-size:16px">1993</br>asfdsfasdfsfsadfasdfasdfasfsfsafsafasfasssadfa台灣，台南市</td>
                    </tr>
                </table>
            </thead>
            <tbody>
                <table width="1024" class="info1">
                    <tr valign="top">
                        <td>
                            <table style="width:320px;">
                                <tr>
                                    <td class="lil">負責人</td>
                                    <td class="lir">王瑞棋&nbsp;&nbsp;Wang Rui Qi</td>
                                </tr>
                                <tr>
                                    <td class="lil">聯絡電話</td>
                                    <td class="lir">+886 12345678</td>
                                </tr>
                                <tr>
                                    <td class="lil">傳真</td>
                                    <td class="lir">+886 12345678</td>
                                </tr>
                                <tr>
                                    <td class="lil">聯絡住址</td>
                                    <td class="lir">103台北市大同區民族西路141號103台北市大同區民族西路141號103</td>
                                </tr>
                                <tr>
                                    <td class="lil">網址</td>
                                    <td class="lir">http://www.galleryaki.com/</td>
                                </tr>
                                <tr>
                                    <td class="lil">展務人聯絡</td>
                                    <td class="lir">王瑞棋<br>+886 0933253467<br>kai.wong@aki.com.tw<br>Line︰ aebs.bb<br>Wechat︰ dex.bb<br>whatapp︰ dex.bb</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table width="320 ">
                                <tr>
                                    <td class="lil">2017</td>
                                    <td class="lir">
                                        讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展<br>灣新文創展讚台灣新文創展創展<br>文化創意博覽會<br>小米豐了！<br>文化創意博覽會讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展<br>灣新文創展讚台灣新文創展創展<br>文化創意博覽會<br>小米豐了！<br>文化創意博覽會</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table width="320 ">
                                <tr>
                                    <td class="lil">2016</td>
                                    <td class="lir">讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展<br>灣新文創展讚台灣新文創展創展<br>文化創意博覽會<br>小米豐了！<br>文化創意博覽會讚台灣新文創展<br>文化博覽會<br>文化創意博覽會<br>小米豐了！<br>文化創意博覽會</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </tbody>
            <tfoot>
                <table class="work" width="1024" valign="top">
                    <tr valign="top">
                        <td style="width:510px;">
                            <table>
                                <tr>
                                    展覽1
                                    <td>
                                        <div class="image" style="background-image: url(table_img/1.jpg);"></div>
                                        <div class="image" style="background-image: url(table_img/2.jpg);"></div>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="history">傳統藝術創新展
                                        <div class="date">2018/13/22</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:510px;">
                            <table>
                                <tr>
                                    展覽2
                                    <td>
                                        <div class="image" style="background-image: url(table_img/3.jpg);"></div>
                                        <div class="image" style="background-image: url(table_img/4.jpg);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="history">傳統藝術創新展統藝術創新展統藝術創新展統藝術創新展統藝術創新展傳統藝術創新展統藝術創新展統藝術創新展統藝術創新展統藝術創新展
                                        <div class="date">2018/13/22</div>
                                    </td>
                                    <!-- <td>2018/13/22</td> -->
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </tfoot>

        </table>
    </div>
    <!-- 徵件資料 -->
    <div id="page">
        <table width="1024" border="0">
            <thead>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td>晴山藝術中心&nbsp;Aki Gallery</td>
                        <td style="text-align: right;font-size:16px">1993</br>asfdsfasdfsfsadfasdfasdfasfsfsafsafasfasssadfa台灣，台南市</td>
                    </tr>
                </table>
            </thead>
            <tbody>
                <table width="1024" class="info2">
                    <!-- 房型 -->
                    <td valign="top" width="200" class="room bdr1px">

                        <table>
                            <tr>
                                <h1>房型選擇</h1>
                                <h2>藝術無限</h2>
                                <ul>
                                    <li>
                                        <span>1</span>豪華套房</li>

                                    <li>
                                        <span>2</span>居家式客方</li>
                                    <li>
                                        <span>3</span>經典套房</li>
                                </ul>
                            </tr>
                            <tr>
                                <h2>Young藝術</h2>
                                <ul>
                                    <li> <span>1</span>豪華套房</li>
                                    <li><span>2</span>居家式客方</li>
                                    <li><span>3</span>經典套房</li>
                                </ul>
                            </tr>
                            <tr>
                                <h2>科技藝術</h2>
                                <ul>
                                    <li>豪華套房</li>
                                </ul>
                            </tr>
                        </table>
                    </td>
                    <!-- 策展主題 -->
                    <td class="topics" valign="top">
                        <table>
                            <tr valign="top">
                                <td class="lil">策展主題</td>
                                <td class="lir_title">
                                    讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展，灣新文創展讚台灣新文創展創展，文化創意博覽會，小米豐了！，文化創意博覽會，
                            </tr>
                            <tr valign="top">
                                <td class="lil">策展說明</td>
                                <td class="lir">
                                    <p> 讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣灣新文創展創展，灣新文創展讚台灣新文創展創展，文化創意博覽會，小米豐了！，文化創意博覽會，
                                    </p>
                                    <p> 讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展，灣新文創展讚台灣新文創展創展，文化創意博覽會，小米豐了！，文化創意博覽會，
                                    </p>
                                    <p> 讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展，灣新文創展讚台灣新文創展創展，文化創意博覽會，小米豐了！，文化創意博覽會，
                                    </p>
                                    <p> 讚台灣新文讚台灣新文創展讚台灣新文創展讚台灣新文創展讚台灣新文創展創展，灣新文創展讚台灣新文創展創展，文化創意博覽會，小米豐了！，文化創意博覽會，
                                    </p>
                                </td>
                            </tr>
                        </table>
                        </td>
                </table>
            </tbody>
        </table>
    </div>
    <!-- 申請藝術家資料  -->
    <div id="page">
        <table width="1024" border="0">
            <tr>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td style="text-align: left;font-size:16px">彭偉新彭偉新彭偉新&nbsp;Peng Wei Shin<br>32歲 / Taiwan</td>
                        <td style="text-align:right;" class="bdr1px">晴山藝術中心&nbsp;Aki Gallery</td>
                        <td style="text-align: right;font-size:16px">1993</br>台灣，台南市</td>
                    </tr>
                </table>
            </tr>
            <tr>
                <table width="1024" class="bdb1px exp">
                    <tr valign="top">
                        <td>
                            <table>
                                <td>
                                    <tr>
                                        <div class="title">學歷</div>
                                    </tr>
                                    <tr>
                                        <div class="list">
                                            <p>2000 豪華套房、居家式客房、經典客房豪華套房<br>1998 居家式客房、經典客房豪華套房、居家式客房 <br>2000 經典客房豪華套房、居家式客房</p>
                                        </div>
                                    </tr>
                                </td>
                            </table>
                        </td>
                        <td>
                            <table>
                                <td>
                                    <tr>
                                        <div class="title">個展/聯展經歷</div>
                                    </tr>
                                    <tr>
                                        <div class="list">
                                            <p>2000 豪華套房、居家式客房、經典客房豪華套房<br>1998 居家式客房、經典客房豪華套房、居家式客房 <br>2000 經典客房豪華套房、居家式客房</p>
                                        </div>
                                    </tr>
                                </td>
                            </table>
                        </td>
                        <td>
                            <table>
                                <td>
                                    <tr>
                                        <div class="title">獲獎/典藏經歷</div>
                                    </tr>
                                    <tr>
                                        <div class="list">
                                            <p>2000 豪華套房、居家式客房、經典客房豪華套房<br>1998 居家式客房、經典客房豪華套房、居家式客房 <br>2000 經典客房豪華套房、居家式客房</p>
                                        </div>

                                    </tr>
                                </td>
                            </table>
                        </td>
                    </tr>
                </table>
            </tr>
            <tr valign="top">
                <table class="work" width="1024" valign="top">
                    <tr valign="top">
                        <td valign="top">
                            <table class="work-info">
                                <tr>
                                    <td>
                                        <div class="image" style="background-image: url(table_img/1.jpg);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="name">Lion</div>
                                        <div class="size">94x27x31</div>
                                        <div class="material">woodcarving, pigment, resinwoodcarving, pigment, resinresinwoodcarving, pigment, resinresinwoodcarving, pigment, resinresinwoodcarving, pigment, resin</div>
                                        <div class="year">2018</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top">
                            <table class="work-info">
                                <tr>
                                    <td>
                                        <div class="image" style="background-image: url(table_img/3.jpg);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="name">Lion</div>
                                        <div class="size">94x27x31</div>
                                        <div class="material">woodcarving, pigment, resin</div>
                                        <div class="year">2018</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top">
                            <table class="work-info">
                                <tr>
                                    <td>
                                        <div class="image" style="background-image: url(table_img/4.jpg);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="name">Lion</div>
                                        <div class="size">94x27x31</div>
                                        <div class="material">woodcarving, pigment, resin</div>
                                        <div class="year">2018</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </tr>

        </table>
    </div>
</body>

</html>