<?php


namespace app\common\util;


use Exception;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelUtil
{
    /**
     * 读取文件
     * @param $path
     * @param $options
     * @return array
     * @throws Exception
     */
    public static function read($path, $options)
    {
        $spreadsheet = IOFactory::load($path);

        $sheet = $spreadsheet->getActiveSheet();

        $data = [];

        /**
         * 循环每一行
         */
        for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {

            $temp = [];

            /**
             * 循环每一列
             */
            for ($column = 1; $column <= Coordinate::columnIndexFromString($sheet->getHighestColumn()); $column++) {

                $title  = $sheet->getCell([$column, 1])->getValue();
                $option = $options[$title];

                if (isset($options[$title])) {

                    $cell  = $sheet->getCell([$column, $row]);
                    $value = $cell->getValue();

                    if ($option['type'] == 'datetime' && Date::isDateTime($cell)) {
                        $value = Date::excelToDateTimeObject($value)->format($option['format']);
                    }

                    $temp[$option['field']] = $value;
                }
            }

            $data[] = $temp;
        }

        return $data;
    }

    /**
     * 写入文件
     * @param $path
     * @param $options
     * @param $data
     * @return void
     * @throws Exception
     */
    public static function save($path, $options, $data)
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        /**
         * 创建映射
         */
        $keyMap = [];

        foreach (array_keys($options) as $key => $field) {
            $keyMap[$field] = $key + 1;
        }

        /**
         * 写入表头
         */
        foreach (array_values($options) as $key => $option) {
            $sheet->setCellValue([$key + 1, 1], $option['title']);
        }

        for ($row = 0; $row < count($data); $row++) {

            /**
             * 写入数据
             */
            foreach ($data[$row] as $name => $value) {

                /**
                 * 检测是否在导出集合中
                 */
                if (isset($keyMap[$name])) {

                    /**
                     * 处理显式格式
                     */
                    if ($options[$name]['explicit']) {
                        if ($options[$name]['type'] == 'string') {
                            $sheet->setCellValueExplicit([$keyMap[$name], $row + 2], $value, DataType::TYPE_STRING);
                        }
                    } else {
                        $sheet->setCellValue([$keyMap[$name], $row + 2], $value);
                    }
                }
            }
        }

        IOFactory::createWriter($spreadsheet, 'Xlsx')->save($path);
    }
}