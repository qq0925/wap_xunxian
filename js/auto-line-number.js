;(function($){
    var AutoRowsNumbers = function (element, config){
        this.$element = $(element);
        this.$group = $('<div/>', { 'class': "textarea-group" });
        this.$ol = $('<div/>', { 'class': 'textarea-rows' });
        this.$wrap = $('<div/>', { 'class': 'textarea-wrap' });

        // 计算样式
        this.$group.css({
            "width" : this.$element.outerWidth(true) + 'px',
            "display" : config.display,
            "position": "relative" // 增加position属性
        });
        this.$ol.css({
            "color" : config.color,
            "width" : config.width,
            "height" : this.$element.height(),
            "font-size" : this.$element.css("font-size"),
            "line-height" : this.$element.css("line-height"),
            "position" : "absolute",
            "overflow" : "hidden",
            "margin" : 0,
            "padding" : 0,
            "text-align": "center",
            "font-family": "仿宋",
            "top": "10px" // 调整位置
        });
        this.$wrap.css({
            "padding" : ((this.$element.outerHeight() - this.$element.height())/2) + 'px 0',
            "background-color" : config.bgColor,
            "position" : "absolute",
            "width" : config.width,
            "height" : this.$element.height() + 'px'
        });
        this.$element.css({
            "white-space" : "pre",
            "margin-left" : (parseInt(config.width) -  parseInt(this.$element.css("border-left-width"))) + 'px',
            "width": (this.$element.width() - parseInt(config.width)) + 'px'
        });
    }

    AutoRowsNumbers.prototype = {
        constructor: AutoRowsNumbers,

        init : function(){
            var that = this;
            that.$element.wrap(that.$group);
            that.$wrap.insertBefore(that.$element);  // 调整插入顺序
            that.$ol.appendTo(that.$wrap);  // 调整插入顺序
            that.$element.on('input',{ that: that }, that.inputText);  // 使用input事件
            that.$element.on('scroll',{ that: that },that.syncScroll);
            that.$element.on('mouseup',{ that: that },that.resizeHandler);  // 添加调整大小的处理程序
            that.inputText({data:{that:that}});
        },

        inputText: function(event){
            var that = event.data.that;

            setTimeout(function(){
                var value = that.$element.val();
                value.match(/\n/g) ? that.updateLine(value.match(/\n/g).length+1) : that.updateLine(1);
                that.syncScroll({data:{that:that}});
            },0);
        },

        updateLine: function(count){
            var that = this;
            that.$element;
            that.$ol.html('');

            for(var i=1; i<=count; i++){
                that.$ol.append("<div>"+i+"</div>");
            }
        },

        syncScroll: function(event){
            var that = event.data.that;
            that.$ol.children().eq(0).css("margin-top",  -(that.$element.scrollTop()) + "px");
        },

        resizeHandler: function(event) {
            var that = event.data.that;
            // 更新行号区域的高度和宽度
            that.$wrap.height(that.$element.height());
            that.$ol.height(that.$element.height());
            // 重新计算padding
            that.$wrap.css("padding", ((that.$element.outerHeight() - that.$element.height())/2) + 'px 0');
        }
    }

    $.fn.setTextareaCount = function(option){
        var config = {};
        var option = arguments[0] ? arguments[0] : {};
        config.color = option.color ? option.color : "#FFF";
        config.width = option.width ? option.width : "30px";
        config.bgColor = option.bgColor ? option.bgColor : "#999";
        config.display = option.display ? option.display : "block";

        return this.each(function () {
            var $this = $(this),
                data = $this.data('autoRowsNumbers');

            if (!data){ $this.data('autoRowsNumbers', (data = new AutoRowsNumbers($this, config))); }
            
            if (typeof option === 'string'){
                return false;
            } else {
                data.init();
            }
        });
    }
})(jQuery);
