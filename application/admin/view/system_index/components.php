{extend name="common@layout/layout" /}

{block name="content"}
<div class="layui-fluid layui-content">

<!--    <div class="layui-card">-->
<!--        <div class="layui-card-header">地图组件</div>-->
<!--        <div class="layui-card-body">-->
<!--            <div class="map" id="map"></div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="layui-card">
        <div class="layui-card-header">文件上传</div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label layui-required">文件选择</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-btn upload">文件选择</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label layui-required">文件上传</label>
                <div class="layui-input-block">
                    <input type="hidden" class="easy-builder-upload">
                </div>
            </div>
        </div>
    </div>

    <div class="layui-card">
        <div class="layui-card-header">图片上传</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">单图上传</label>
                    <div class="layui-input-block">
                        <input type="hidden" class="layui-builder-image">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">多图上传</label>
                    <div class="layui-input-block">
                        <input type="hidden" class="layui-builder-picture">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">限制数量</label>
                    <div class="layui-input-block">
                        <input type="hidden" class="layui-builder-picture" data-max="5">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="layui-card">
        <div class="layui-card-header">图片预览</div>
        <div class="layui-card-body">
            <div class="easy-preview" data-picture="/upload/image/20231024/47220acdd326647e029949627e49b197.jpg,/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg"></div>
        </div>
    </div>

    <div class="layui-card">
        <div class="layui-card-header">联级选择器</div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label">联级选择器</label>
                <div class="layui-input-block">
                    <div id="cascader"></div>
                </div>
            </div>
            <br>
            <div class="layui-form-item">
                <label class="layui-form-label">下拉菜单</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-btn" id="dropMenu">
                        <i class="fa fa-fw fa-arrow-down"></i>下拉菜单
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-card">
        <div class="layui-card-header">富文本编辑器</div>
        <div class="layui-card-body">
            <script class="easy-ueditor" type="text/plain"></script>
        </div>
    </div>

    <div class="layui-card">
        <div class="layui-card-header">字典调用</div>
        <div class="layui-card-body">
            {dictionary:list identify="newsTag"}
            {{#  if(d.status == '{$dict.value}'){ }}<span class="layui-badge {$dict.style}">{$dict.label}</span>{{#  } }}
            {/dictionary:list}
        </div>
    </div>

    <div class="layui-card">
        <div class="layui-card-header">权限标签</div>
        <div class="layui-card-body">

            {permission:check menuIds="1,2,1515151" condition="and"}
            <h1>已授权</h1>
            {else/}
            <h1>未授权</h1>
            {/permission:check}
            <br>

            {permission:check menuIds="1,2,1515151" condition="or"}
            <h1>已授权</h1>
            {else/}
            <h1>未授权</h1>
            {/permission:check}

            <br>
        </div>
    </div>

    <div class="split easy-split" data-direction="horizontal">
        <div class="split-item" data-size="15">
            <div class="split-fill layui-card">
                <div class="layui-card-header">面板分割</div>
                <div class="layui-card-body">
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                </div>
            </div>
        </div>
        <div class="split-item" data-size="85">
            <div class="split-fill layui-card">
                <div class="layui-card-header">面板分割</div>
                <div class="layui-card-body">
                    <form class="layui-form">
                        <div class="layui-form-item">
                            <label class="layui-form-label layui-required">状态</label>
                            <div class="layui-input-block">
                                <input type="radio" name="status" value="1" title="启用" checked="">
                                <input type="radio" name="status" value="2" title="禁用">
                                <input type="radio" name="status" value="3" title="锁定">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">登录状态</label>
                            <div class="layui-input-block">
                                <select name="status">
                                    <option value=""></option>
                                    <option value="1">登录成功</option>
                                    <option value="2">登录失败</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label layui-required">测试文本</label>
                            <div class="layui-input-block">
                                <textarea name="content" lay-verify="required" placeholder="请填写测试文本"
                                          class="layui-textarea"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button type="submit" class="layui-btn" lay-submit="">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="split easy-split" data-direction="vertical">
        <div class="split-item" data-size="15">
            <div class="split-fill layui-card">
                <div class="layui-card-header">面板分割</div>
                <div class="layui-card-body">
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                    <h1>dsadas</h1>
                </div>
            </div>
        </div>
        <div class="split-item" data-size="85">
            <div class="split-fill layui-card">
                <div class="layui-card-header">面板分割</div>
                <div class="layui-card-body">
                    <form class="layui-form">
                        <div class="layui-form-item">
                            <label class="layui-form-label layui-required">状态</label>
                            <div class="layui-input-block">
                                <input type="radio" name="status" value="1" title="启用" checked="">
                                <input type="radio" name="status" value="2" title="禁用">
                                <input type="radio" name="status" value="3" title="锁定">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">登录状态</label>
                            <div class="layui-input-block">
                                <select name="status">
                                    <option value=""></option>
                                    <option value="1">登录成功</option>
                                    <option value="2">登录失败</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label layui-required">测试文本</label>
                            <div class="layui-input-block">
                                <textarea name="content" lay-verify="required" placeholder="请填写测试文本"
                                          class="layui-textarea"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button type="submit" class="layui-btn" lay-submit="">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="layui-card">
        <div class="layui-card-header">日期选择器</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">日期选择</label>
                    <div class="layui-input-block">
                        <input type="text" lay-verify="required" placeholder="请选择日期"
                               class="layui-input easy-build-date">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">时间选择</label>
                    <div class="layui-input-block">
                        <input type="text" lay-verify="required" placeholder="请选择时间"
                               class="layui-input easy-build-time">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">日期时间</label>
                    <div class="layui-input-block">
                        <input type="text" lay-verify="required" placeholder="请选择日期时间"
                               class="layui-input easy-build-datetime">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
{/block}

{block name="js"}
<script src="https://map.qq.com/api/gljs?v=1.exp&libraries=service,geometry,tools&key=CD4BZ-URFWP-YRDDF-L6D4S-5WHCV-5TFP5"></script>
<script>

    layui.use(['easyModule'], function () {

        const easyMap = layui.easyMap;
        const easyAdmin = layui.easyAdmin;
        const easyBuilder = layui.easyBuilder;

        $('.upload').on('click', function () {
            easyAdmin.openFileLayer({
                fileType: ['image', 'video'],
                selectFile: function (fileList) {
                    console.log(fileList)
                }
            })
        });

        easyBuilder.dropMenu({
            elem: "#dropMenu",
            data: [{
                icon: 'fa fa-fw fa-download',
                title: 'menu item 1',
                event: 'create'
            }, {
                icon: 'fa fa-fw fa-download',
                title: 'menu item 2',
                event: 'update'
            }, {
                icon: 'fa fa-fw fa-download',
                title: 'menu item 3',
                event: 'delete'
            }],
            click: (event) => {
                console.log(event)
            }
        });

        const data = [
            {id: 1, parentId: 0, name: '指南'},
            {id: 2, parentId: 1, name: '说明'},
            {id: 3, parentId: 0, name: '设计'},
            {id: 4, parentId: 3, name: '图稿'}
        ];

        easyBuilder.cascader({
            elem: "#cascader",
            checked: [3, 4]
        }, {
            clearable: false,
            filterable: false,
        }, data);

        // const map = new TMap.Map('map', {
        //     pitch: 0,
        //     zoom: 14,
        // });
        //
        // easyMap.autoMarker({
        //     map: map
        // });
        //
        // easyMap.autoSearch({
        //     map: map
        // });
        //
        // easyMap.autoLocation({
        //     map: map
        // });
        //
        // easyMap.autoCircle({
        //     map: map
        // })
        //
        // easyMap.autoAddress({
        //     map: map,
        //     change(data) {
        //         console.log(data)
        //     }
        // });
    });
</script>
{/block}