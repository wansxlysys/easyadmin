<script>

    const menuData = {
        type: 1,
        parentId: 0
    }

    const menuService = {
        /**
         * 初始化
         */
        initService: function () {
            menuService.renderMenuSelect();
            menuService.listenType(menuData.type);
        },
        /**
         * 创建菜单选择器
         */
        renderMenuSelect: function () {
            layui.easyService.menuTreeSelect({
                elem: "#menu",
                checked: menuData.parentId
            }, {
                name: 'parentId',
                layVerify: 'required'
            });
        },
        /**
         * 渲染链接地址
         */
        renderLink: function (type) {
            if (type == 3) {
                $("input[name=link]").attr('lay-verify', 'required').closest(".layui-form-item").removeClass("layui-hide");
            } else {
                $("input[name=link]").removeAttr('lay-verify').closest(".layui-form-item").addClass("layui-hide");
            }
        },
        /**
         * 监听菜单类型
         */
        listenType: function (type) {
            layui.form.on("radio(type)", function (obj) {
                menuService.renderLink(obj.value);
            });

            menuService.renderLink(type);
        }
    }

</script>