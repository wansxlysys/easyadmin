<?php


namespace app\admin\command;


use Exception;

use FilesystemIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

use think\Db;
use think\facade\Env;

use think\console\Command;
use think\console\Input;
use think\console\Output;

use app\admin\enum\SystemUploadEnum;

class UploadClean extends Command
{
    /**
     * 配置命令
     * php think upload:clean
     */
    protected function configure()
    {
        $this->setName('upload:clean')->setDescription('Clean Upload Files');
    }

    /**
     * 执行命令
     * @param Input $input
     * @param Output $output
     * @throws Exception
     */
    protected function execute(Input $input, Output $output)
    {
        $uploadPath = Env::get('root_path') . 'public';

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($uploadPath . SystemUploadEnum::UPLOAD_DIR, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        $fileList = [];

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $fileList[] = str_replace([$uploadPath, DIRECTORY_SEPARATOR], ['', '/'], $file->getPathname());
            }
        }

        foreach ($fileList as $path) {

            $savePath = $uploadPath . $path;
            $fileInfo = Db::name('system_upload')->where('path', $path)->find();

            if (empty($fileInfo) && file_exists($savePath)) {
                unlink($savePath);
            }
        }

        Db::name('system_upload')->whereNotIn('path', $fileList)->delete();
    }
}