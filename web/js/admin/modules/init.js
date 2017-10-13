define(function(require, exports, module) {
    exports.confirm = function(url,message,reload){
        var dialog = require('artDialog/dialog');
        reload = (typeof(reload)==="undefined")?false:reload;

        var d = dialog({
            title: '系统提示',
            content: message,
            width : 400,
            height:40,
            okValue: '确定',
            ok: function () {
                this.title('处理中…');
                $.getJSON(url,function(result){
                    if(result.done === true){
                        d.close().remove();
                        exports.DoMessage(result.data,1500,function(){
                            window.location.reload();
                        });
                        return true;
                    }else{
                        exports.DoMessage(result.error,5000);
                        return false;
                    }

                });
            },
            cancelValue: '取消',
            cancel: function () {}
        });
        d.show();
    };

    exports.DoMessage = function(message,second,callback){
        second = (typeof(second) === "undefined")?1000:second;
        var dialog = require('artDialog/dialog');
        var d = dialog({
            skin:'dialog-message',
            content: message,
            quickClose: true// 点击空白处快速关闭
        });
        d.show();
        setTimeout(function(){
            if(typeof(callback)=="function"){
                callback();
            }else{
                d.close().remove();
            }
        },second);
    };

    /**
     * 上传文件
     *
     * @param target
     * @param url
     * @param callback
     * @author abei<abei@nai8.me>
     */
    exports.upload = function(target,url,callback){
        var uploader = WebUploader.create({
            auto: true,
            server: url,
            pick: '#'+target,
            resize: false
        });
        uploader.on('uploadSuccess', function( file ,response) {
            if(response.done === false){
                exports.DoMessage(response.error);
            }else{
                if(typeof(callback)==="function"){
                    callback(response);
                }
            }
        });
    };
});