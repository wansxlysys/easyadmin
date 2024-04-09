{extend name="admin@layout/layout" /}

{block name="content"}
<div class="layui-fluid layui-content">

    <div class="layui-card">
        <div class="layui-card-header">文件上传</div>
        <div class="layui-card-body">
            <div class="layui-form-item layui-form-item-button">
                <label class="layui-form-label">文件选择</label>
                <div class="layui-input-block">
                    <input type="text" name="file_path" placeholder="请选择文件" readonly class="layui-input">
                    <button type="button" class="layui-btn" id="upload">
                        <i class="layui-icon layui-icon-upload-drag"></i>上传
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
        <div class="layui-card-header">权限标签</div>
        <div class="layui-card-body">

            {taglib name="\app\common\taglib\Permission" /}

            {permission:allow menu="1,2,1515151" condition="and"}
            <h1>已授权</h1>
            {else/}
            <h1>未授权</h1>
            {/permission:allow}
            <br>

            {permission:allow menu="1,2,1515151" condition="or"}
            <h1>已授权</h1>
            {else/}
            <h1>未授权</h1>
            {/permission:allow}

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
                                <textarea name="content" lay-verify="required" placeholder="请填写测试文本" class="layui-textarea"></textarea>
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
                                <textarea name="content" lay-verify="required" placeholder="请填写测试文本" class="layui-textarea"></textarea>
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
        <div class="layui-card-header">权限标签</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">日期选择</label>
                    <div class="layui-input-block">
                        <input type="text" lay-verify="required" placeholder="请选择日期" class="layui-input easy-build-date">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">时间选择</label>
                    <div class="layui-input-block">
                        <input type="text" lay-verify="required" placeholder="请选择时间" class="layui-input easy-build-time">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">日期时间</label>
                    <div class="layui-input-block">
                        <input type="text" lay-verify="required" placeholder="请选择日期时间" class="layui-input easy-build-datetime">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule'], function () {

        const uploadFile = layui.uploadFile;

        new uploadFile({
            id: "upload",
            url: "{:url('admin/SystemUpload/slice')}",
            check_url: "{:url('admin/SystemUpload/check')}"
        });
    });
</script>
{/block}