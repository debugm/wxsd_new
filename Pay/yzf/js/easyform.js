/*
描述：基于jquery的表单验证插件。
*/

(function ($) {
    $.fn.checkForm = function (options) {
        var root = this; //将当前应用对象存入root

        var isok = false; //控制表单提交的开关

        var pwd1; //密码存储

        var defaults = {
            //图片路径
            img_error: "/pay/images/error.png",
            img_success: "/pay/images/success.png",

            //提示信息
            tips_success: '', //验证成功时的提示信息，默认为空
            tips_required: '不能为空',
            tips_num: '请填写数字',

            //正则
            reg_num: /^\d+$/,         //验证数字
        };

        //不为空则合并参数
        if(options)
            $.extend(defaults, options);

        //获取（文本框，密码框，多行文本框），当失去焦点时，对其进行数据验证
        $(":text", root).each(function () {
            $(this).blur(function () {
                var _validate = $(this).attr("check"); //获取check属性的值
                if (_validate) {
                    var arr = _validate.split(' '); //用空格将其拆分成数组
                    for (var i = 0; i < arr.length; i++) {
                        //逐个进行验证，不通过跳出返回false,通过则继续
                        if (!check($(this), arr[i], $(this).val()))
                            return false;
                        else
                            continue;
                    }
                }
            })
        })

        //表单提交时执行验证,与上面的方法基本相同，只不过是在表单提交时触发
        function _onSubmit() {
            isok = true;
            $(":text", root).each(function () {
                var _validate = $(this).attr("check");
                if (_validate) {
                    var arr = _validate.split(' ');
                    for (var i = 0; i < arr.length; i++) {
                        if (!check($(this), arr[i], $(this).val())) {
                            isok = false; //验证不通过阻止表单提交，开关false
                            return; //跳出
                        }
                    }
                }
            });
        }

        //判断当前对象是否为表单，如果是表单，则提交时要进行验证
        if (root.is("form")) {
            root.submit(function () {
                _onSubmit();
                return isok;
            })
        }


        //验证方法
        var check = function (obj, _match, _val) {
            //根据验证情况，显示相应提示信息，返回相应的值
            switch (_match) {
                case 'required':
                    return _val ? showMsg(obj, defaults.tips_success, true) : showMsg(obj, defaults.tips_required, false);
                case 'num':
                    return chk(_val, defaults.reg_num) ? showMsg(obj, defaults.tips_success, true) : showMsg(obj, defaults.tips_num, false);
                default:
                    return true;
            }
        }


        //正则匹配(返回bool值)
        var chk = function (str, reg) {
            return reg.test(str);
        }

        //显示信息
        var showMsg = function (obj, msg, mark) {
            $(obj).next("#errormsg").remove();//先清除
            var _html = "<span id='errormsg' style='font-size:13px;color:gray;background:url(" + defaults.img_error + ") no-repeat 0 0;padding-left:20px;margin-left:10px;'>" + msg + "</span>";
            if (mark)
                _html = "<span id='errormsg' style='font-size:13px;color:gray;background:url(" + defaults.img_success + ") no-repeat 0 0;padding-left:20px;margin-left:10px;'>" + msg + "</span>";
            $(obj).after(_html);//再添加
            return mark;
        }
    }
})(jQuery);