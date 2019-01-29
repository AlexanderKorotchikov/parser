<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<?
require_once 'simple_html_dom.php';

function curl_get($url, $referer = 'https://www.google.ru/'){
    $useragent = [
        'Mozilla/0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 7.0; SM-G930VC Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/58.0.3029.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SM-G935S Build/MMB29K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/55.0.2883.91 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SM-G920V Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.1.1; SM-G928X Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 6P Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0; HTC One M9 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.3',
        'Mozilla/5.0 (Linux; Android 6.0; HTC One X10 Build/MRA58K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.98 Mobile Safari/537.36',
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.1058',
        'Mozilla/5.0 (X11; U; Linux armv7l like Android; en-us) AppleWebKit/531.2+ (KHTML, like Gecko) Version/5.0 Safari/533.2+ Kindle/3.0+',
        'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)',
        'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7412.EU',
    ];
    $agent = $useragent[rand(11)];
    $req = curl_init();
    $opt = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_AUTOREFERER => true,
        CURLOPT_REFERER => $referer,
        CURLOPT_USERAGENT => $agent,
    );
    curl_setopt_array($req, $opt);
    // $proxy = '168.235.109.30:16143';
    // $proxyUserpsw = 'pdgPp9:FUqWXw';
    // curl_setopt($req, CURLOPT_PROXY, $proxy);
    // curl_setopt($req, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    // curl_setopt($req, CURLOPT_PROXYUSERPWD, $proxyUserpsw);
    $returns = curl_exec($req);
    curl_close($req);
    // echo 'ds';
    // echo $returns;
    // die;
    return $returns;
}

// ---------------------------------------------test--------------------------------test--------------------------
// $html2 = curl_get('https://ipeopleprospekt.olx.ua/');
// $dom2 = str_get_html($html2);
// $phone = $dom2->find('.shop-sidebar__user-data li div span.block');
// foreach ($phone as $key) {
//     echo $key->innertext . '<br>';
// }
// // echo '<pre>';
// // var_dump($phone);
// die;

// ---------------------------------------------------------------------------------------------------------------



function parseNumbers($url){
    sleep(60);
    $useragent = [
        'Mozilla/0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 7.0; SM-G930VC Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/58.0.3029.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SM-G935S Build/MMB29K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/55.0.2883.91 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SM-G920V Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.1.1; SM-G928X Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 6P Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0; HTC One M9 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.3',
        'Mozilla/5.0 (Linux; Android 6.0; HTC One X10 Build/MRA58K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.98 Mobile Safari/537.36',
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.1058',
        'Mozilla/5.0 (X11; U; Linux armv7l like Android; en-us) AppleWebKit/531.2+ (KHTML, like Gecko) Version/5.0 Safari/533.2+ Kindle/3.0+',
        'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)',
        'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7412.EU',
    ];
    $agent = $useragent[rand(11)];
    //$url = 'https://www.olx.ua/obyavlenie/poslednie-dni-aktsii-bolshoy-chemodan-po-tsene-srednego-polsha-IDzmWQc.html';

//    unlink( $_SERVER['DOCUMENT_ROOT'].'/cookie.dat');
    $cookie_path = $_SERVER['DOCUMENT_ROOT'].'/cookie.dat';
    //echo $cookie_path;

    preg_match('|-ID(.*).html|', $url, $id);
    //echo var_dump($id);
    $olx = curl_init($url);
    curl_setopt($olx, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($olx, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($olx, CURLOPT_HEADER, 1);
     curl_setopt($olx, CURLOPT_COOKIEFILE, $cookie_path);
     curl_setopt($olx, CURLOPT_COOKIEJAR, $cookie_path);
    $result = curl_exec($olx);
    curl_close($olx);
    //echo $result;
    //die;

    preg_match("|phoneToken = '(.*)';|", $result, $token);
    //echo var_dump($id);
    //echo var_dump($token);
    //echo 'https://www.olx.ua/ajax/misc/contact/phone/' . $id[1] . '/?pt=' . $token[1] . '<br>';
    $olx_number = curl_init('https://www.olx.ua/ajax/misc/contact/phone/' . $id[1] . '/?pt=' . $token[1]);
        curl_setopt($olx_number, CURLOPT_HTTPHEADER, [
                'Host: www.olx.ua',
                'Accept: */*',
                'Accept-Language: uk,ru;q=0.8,en-US;q=0.5,en;q=0.3',
                'Accept-Encoding: gzip, deflate, br',
                'Connection: keep-alive',
                'X-Requested-With: XMLHttpRequest'
            ]);
            curl_setopt($olx_number, CURLOPT_REFERER, $url);
            curl_setopt($olx_number, CURLOPT_USERAGENT, $agent);
            curl_setopt($olx_number, CURLOPT_COOKIEFILE, $cookie_path);
            curl_setopt($olx_number, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($olx_number, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($olx_number);
            curl_close($olx_number);
           
         
            $json = json_decode($result);
            //echo $json->value;
            //echo $json->value . '<br>';
            return $json->value;

}

// -------------------------------------------------------------------------------------------


// Получение категорий
// $html = curl_get('https://www.olx.ua/sitemap/');
// $dom = str_get_html($html);
// $categories = $dom->find('.site-map a');
// $category_name = array();
// $category_href = array();
// foreach ($categories as $category){
//     $category_name[] = $category->innertext;
//     $category_href[] = $category->href;

// }

$url = 'https://www.olx.ua/list/?search%5Bprivate_business%5D=business&search%5Bad_homepage_to%3Afrom%5D=2019-01-17';
$start = microtime(true);
$pars_top = parseOLXtop($url);
echo $pars_top;
$time = microtime(true) - $start;
echo '<br><br>'.$time;
function parseOLXtop($url){
    set_time_limit(0);
    error_reporting(1);
    $link = mysqli_connect(
        'localhost',  /* Хост, к которому мы подключаемся */
        'root',       /* Имя пользователя */
        '',   /* Используемый пароль */
        'olx');     /* База данных для запросов по умолчанию */

    if (!$link) {
        $result = array(
            '$cuont_insert_db' => "Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error(),
        );
        // Переводим массив в JSON
        echo json_encode($result);
        exit;
    }
    //$db = new DataBase('localhost', 'root', '', 'olx');
    sleep(2);
    $html = curl_get($url);
    //$start = microtime(true);
    $dom = str_get_html($html);
    $count_page = $dom->find('.pager .fleft span');
    $count_all_page = $count_page[count($count_page) - 1]->innertext;
    //$i_count_pages = 1;
    // echo (int)$count_all_page;
    // die;
    $cuont_insert_db = 0;
    for ($j=100; $j <= 400; $j++) { 
    //for ($j=1; $j <= 100; $j++) { 
        echo $j . '<br>';
        sleep(12);
        //$html = curl_get($url . "?search%5Bpaidads_listing%5D=1&page=$j");
        $html = curl_get($url . '&page='. $j);
        echo $url . '&page='. $j . '<br>';
        $dom4 = str_get_html($html);
        if (is_object($dom4) == FALSE){continue;}
        //die;
        //echo $html;
        
        //if (is_object($dom4) == ''){continue;}
        $offers = $dom4->find('#offers_table tbody tr.wrap');
        
        //if ($offers == ''){goto endforr;}
        $count_offer = count($offers);
        //$i = 0;
        foreach ($offers as $offer) {
            sleep(4);
            $a = $offer->find('a', 0);
            $html1 = curl_get($a->href);
            $page_nunmber = $a->href;
            $dom1 = str_get_html($html1);
            if (is_object($dom1) == FALSE){continue;}
            // $status = $dom1->find('td.value strong a');
            // echo $a->href . '<br>';
            // echo $stat[0]->innertext . '<br>';
            // echo '<pre>';
            // var_dump($status);
            // die;
            //if (!is_object($dom1)){continue;}
            $offer_i = $dom1->find('.offer-user__details  a.user-offers');
            //if ($offer_i == ''){goto endforeachh;}
            $names = $dom1->find('.offer-user__details  h4 a');
            if ($names[0]->innertext == ''){
                $name = '-';
            }
            $name = $names[0]->innertext;
            $all_product_user = $offer_i[0]->href; // Ссылка на продовца
            echo 'User: '.$all_product_user . '<br>';
            sleep(2);
            if ($all_product_user != '') {
                $needle = '/list/user/';
                $pos = strripos($all_product_user, $needle);
                if ($pos != '') {
                    $html2 = curl_get($all_product_user);
                    $dom2 = str_get_html($html2);
                    if (is_object($dom2) == FALSE){
                        sleep(5);
                        continue;
                    }
                    sleep(10);
                    $phone = strip_tags(parseNumbers($page_nunmber));
                    echo 'Phone: '. $phone . '<br>';
                    //if (is_object($dom2) == ''){continue;}
                    $offers_user = $dom2->find('#offers_table>tbody>tr.wrap'); // count($offers_user) - кол товаров
                    //if ($offers_user == ''){goto endforeachh;}
                    $count_page = $dom2->find('.pager .fleft span');
                    $count_all_page = $count_page[count($count_page) - 1]->innertext;
                    if ($count_all_page != 0) {
                        $count_products = count($offers_user) * $count_all_page;
                    } else {
                        $count_products = count($offers_user);
                    }

                } else {
                    $html2 = curl_get($all_product_user);
                    $dom2 = str_get_html($html2);
                    if (is_object($dom2) == FALSE){
                        sleep(5);
                        continue;
                    }
                    $phones = '';
                    $phone = $dom2->find('.shop-sidebar__user-data li div span.block');
                    foreach ($phone as $value) {
                        $phones .= $value . ' | ';
                    }
                    if ($phones == ''){
                        $phones = '';
                        $phone = $dom2->find('.shopheader__cell--phonebox div.inner div span.block');
                        foreach ($phone as $value) {
                            $phones .= $value . ' | ';
                        }
                    }
                    echo 'Phone: '. $phones . '<br>';
                    // die;
                    $offers_user = $dom2->find('.rel>#listContainer>table.offers>tbody>tr>td.offer');
                    //if ($offers_user == ''){goto endforeachh;}
                    $count_page = $dom2->find('.pager .fleft span');
                    $count_all_page = $count_page[count($count_page) - 1]->innertext;
                    if ($count_all_page != 0) {
                        $count_products = count($offers_user) * $count_all_page;
                    } else {
                        $count_products = count($offers_user);
                    }
                    //$phone = $dom2->find('.inner span.block');
                    //$phone = '-';
                    $site = '-';
                    $phone = strip_tags($phones);
                    //$site = $dom2->find('.inner a');
                }

                if ($result = mysqli_query($link, "SELECT * FROM customers_top WHERE customer_url = '$all_product_user'")) {
                    $row = $result->fetch_assoc();
                    if ($row['customer_url'] == '') {
                        $count_zap_db = 0;
                    } else {
                        $count_zap_db = 1;
                    }
                }

                //echo $count_zap_db . '<br>';
                if ($count_zap_db == 0) {
                    //insert
                    $sql = "INSERT INTO customers_top(name_u, customer_url, site, phone, count_products)VALUES('$name', '$all_product_user', '$site', '$phone', $count_products)";
                    if ($link->query($sql) === TRUE) {
                        $cuont_insert_db++;
                    }
                }
                //}
            }
            echo '<br>';
        }
        //break;
        //echo '<br>Записей добавленно в БД: '.$cuont_insert_db . '<br>';
        //$time = microtime(true) - $start;
        //echo '<br>Время выполнения скрипта - ' . $time;
        //$i_count_pages++;
        // if ($j == 50){
        //     break;
        // }
    }
    return $cuont_insert_db;
}
die;
?>

<html>
<body>
    <form method="post" id="ajax_form" action="" >
        <select name="name" id="name">
            <?
            for ($i=0; $i< count($category_name)-1; $i++){
            ?>
            <option value="<?=$category_href[$i]?>"><?=$category_name[$i]?></option>
            <?}?>
        </select>
        <?
        /*for ($i=0; $i< count($category_name)-1; $i++){*/
        ?>
        <!--<input style="visibility: hidden;" type="text" name="phonenumber" placeholder="YOUR PHONE" value="<?/*=$category_href[$i]*/?>"/><br>-->
        <?/*}*/?>
        <input type="button" id="btn" value="Парсить" />
        <input type="button" id="btntop" value="Парсить топы" />
    </form>

    <div id="result_form"><div>

</body>

<script>

$( document ).ready(function() {
    $("#btn").click(
        function(){
            sendAjaxForm('result_form', 'ajax_form', 'parseOlx.php');
            return false;
        }
    );
});

$( document ).ready(function() {
    $("#btntop").click(
        function(){
            sendAjaxForm2('result_form', 'ajax_form', 'parsetop.php');
            return false;
        }
    );
});


function sendAjaxForm(result_form, ajax_form, url) {
    $("#result_form").html('Парситься');
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            $('#result_form').html('В базу добавленно: '+result.$cuont_insert_db);
        },
        error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}

function sendAjaxForm2(result_form, ajax_form, url) {
    $("#result_form").html('Парситься');
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            $('#result_form').html('В базу добавленно: '+result.$cuont_insert_db);
        },
        error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}

</script>
</html>

