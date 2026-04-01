{extend name="common@layout/layout" /}

{block name="css"}
<style>
    .chart {
        width: 100%;
        height: 450px;
    }

    .lay-big-font {
        font-size: 36px;
        line-height: 36px;
        padding: 10px 0 15px;
    }

    .lay-small-font {
        font-size: 22px;
        line-height: 1;
        margin-left: 5px;
        vertical-align: middle;
    }

    .layui-card-header .layui-badge {
        margin-top: 2px;
    }
</style>
{/block}

{block name="content"}
<div class="layui-fluid layui-content">
    <div class="one-alert">
        <div class="one-alert-icon">
            <i class="fa fa-fw fa-regular fa-face-grin-wide"></i>
        </div>
        <div class="one-alert-content">
            <h3>欢迎登录</h3>
            <p>欢迎使用{$systemSetting.systemName}</p>
        </div>
        <div class="one-alert-close">
            <i class="fa fa-fw fa-close"></i>
        </div>
    </div>
    <div class="layui-row layui-col-space15">
        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    访问量<span class="layui-badge layui-bg-danger one-float-right">今日</span>
                </div>
                <div class="layui-card-body">
                    <p class="lay-big-font">25,848<span class="lay-small-font">次</span></p>
                    <p>总访问量<span class="one-float-right">280 万</span></p>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    销售金额<span class="layui-badge layui-bg-primary one-float-right">金额</span>
                </div>
                <div class="layui-card-body">
                    <p class="lay-big-font">12,000<span class="lay-small-font">¥</span></p>
                    <p>总销售额<span class="one-float-right">68 万</span></p>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    订单量<span class="layui-badge layui-bg-warning one-float-right">本周</span>
                </div>
                <div class="layui-card-body">
                    <p class="lay-big-font">1,680<span class="lay-small-font">单</span></p>
                    <p>转化率<span class="one-float-right">60%</span></p>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    新增用户<span class="layui-badge layui-bg-success one-float-right">新增</span>
                </div>
                <div class="layui-card-body">
                    <p class="lay-big-font">128<span class="lay-small-font">人</span></p>
                    <p>用户总数<span class="one-float-right">10800 人</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            <div class="layui-card">
                <div class="layui-card-header">访问统计</div>
                <div class="layui-card-body">
                    <div class="chart" id="line"></div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">性别比例</div>
                <div class="layui-card-body">
                    <div class="chart" id="pie"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}

{block name="js"}
<script src="{:static_url('/admin/plugin/echarts/echarts.min.js')}"></script>
<script>
    layui.use(['oneModule'], function () {

        const chartPie = echarts.init(document.getElementById('pie'));
        const chartLine = echarts.init(document.getElementById('line'));

        chartLine.setOption({
            title: {
                text: '折线图'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['电子邮件', '联盟广告', '视频广告', '直接访问', '搜索引擎']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name: '电子邮件',
                    type: 'line',
                    smooth: true,
                    data: [120, 132, 101, 134, 90, 230, 210]
                },
                {
                    name: '联盟广告',
                    type: 'line',
                    smooth: true,
                    data: [220, 182, 191, 234, 290, 330, 310]
                },
                {
                    name: '视频广告',
                    type: 'line',
                    smooth: true,
                    data: [289, 232, 201, 154, 190, 330, 410]
                },
                {
                    name: '直接访问',
                    type: 'line',
                    smooth: true,
                    data: [320, 368, 301, 289, 390, 168, 320]
                },
                {
                    name: '搜索引擎',
                    type: 'line',
                    smooth: true,
                    data: [820, 932, 901, 934, 879, 1330, 785]
                }
            ]
        });

        chartPie.setOption({
            title: {
                text: '饼状图',
                subtext: '来源',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '50%',
                    data: [
                        {value: 1048, name: '搜索引擎'},
                        {value: 735, name: '直接访问'},
                        {value: 580, name: '电子邮件'},
                        {value: 484, name: '联盟广告'},
                        {value: 300, name: '视频广告'}
                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        });

        jQuery(window).resize(function () {
            chartPie.resize();
            chartLine.resize();
        });
    });
</script>
{/block}