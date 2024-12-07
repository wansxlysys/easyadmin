<?php


namespace app\common\command\generator;


use app\common\util\ConsoleUtil;

class Handler
{
    /**
     * 替换占位
     * @var array
     */
    private $search = [
        '{{class}}',
        '{{comment}}'
    ];

    /**
     * 替换内容
     * @var array
     */
    private $replace = [];

    /**
     * 保存模块
     * @var string
     */
    private $module = '';

    /**
     * 保存业务层
     * @var string
     */
    private $layer = '';

    /**
     * 创建类名
     * @var string
     */
    private $class = '';

    /**
     * 模板名称
     * @var
     */
    private $stub = '';

    /**
     * 设置模板
     * @param string $stub
     */
    public function setStub(string $stub)
    {
        $this->stub = $stub;
    }

    /**
     * 设置替换
     * @param array $replace
     * @return void
     */
    public function setReplace(array $replace)
    {
        $this->replace = $replace;
    }

    /**
     *
     * 设置模块
     * @param string $module
     * @return void
     */
    public function setModule(string $module)
    {
        $this->module = $module;
    }

    /**
     * 设置业务层
     * @param string $layer
     * @return void
     */
    public function setLayer(string $layer)
    {
        $this->layer = $layer;
    }

    /**
     * 设置类名
     * @param string $class
     * @return void
     */
    public function setClass(string $class)
    {
        $this->class = $class;
    }

    /**
     * 获取模板
     * @return string
     */
    protected function getStub()
    {
        return file_get_contents(env('app_path') . 'common/command/generator/stub/' . $this->stub . '.stub');
    }

    /**
     * 获取保存目录
     * @return string
     */
    protected function getPath()
    {
        return env('app_path') . $this->module . DIRECTORY_SEPARATOR . $this->layer . DIRECTORY_SEPARATOR . $this->class . ucfirst($this->layer) . '.php';
    }

    /**
     * 生成代码
     * @return void
     */
    public function generate()
    {
        $fileText = $this->getStub();
        $savePath = $this->getPath();

        if (file_exists($savePath)) {
            ConsoleUtil::writeln('文件存在：' . $savePath);
        } else {
            ConsoleUtil::writeln('创建成功：' . $savePath);
            file_put_contents($savePath, str_replace($this->search, $this->replace, $fileText));
        }
    }
}