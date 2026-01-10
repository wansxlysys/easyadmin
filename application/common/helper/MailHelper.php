<?php


namespace app\common\helper;


use Exception;

use PHPMailer\PHPMailer\PHPMailer;

use app\common\dependency\Dependency;
use app\admin\service\SystemDictDataService;

class MailHelper
{
    /**
     * 加载文件
     * @param array $params
     * @return void
     * @throws Exception
     */
    public static function sendMail(array $params)
    {
        $mailConfig = Dependency::getProxy(SystemDictDataService::class)
            ->getKeyMapSystemDictData('system.mail.config');

        $PHPMailer = new PHPMailer(true);

        $PHPMailer->Port       = $mailConfig['port'];
        $PHPMailer->Host       = $mailConfig['host'];
        $PHPMailer->Username   = $mailConfig['username'];
        $PHPMailer->Password   = $mailConfig['password'];
        $PHPMailer->SMTPAuth   = true;
        $PHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $PHPMailer->Body    = $params['body'];
        $PHPMailer->Subject = $params['subject'];

        $PHPMailer->isSMTP();
        $PHPMailer->setFrom('1628883533@qq.com');
        $PHPMailer->addAddress($params['address']);

        /**
         * 抄送/密送
         */
        $ccAddress  = $params['ccAddress'] ?? [];
        $bccAddress = $params['bccAddress'] ?? [];

        foreach ($ccAddress as $address) {
            $PHPMailer->addCC($address);
        }

        foreach ($bccAddress as $address) {
            $PHPMailer->addBCC($address);
        }

        $PHPMailer->send();
    }
}