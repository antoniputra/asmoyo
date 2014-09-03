(function ($) {

    var TEMPLATE    = 
        '<div class="col-sm-12"> \n' +
        '   <div class="form-group">\n' +
        '      <label class="col-sm-2 control-label">\n' +
        '          {labelResource} \n' +
        '       </label> \n' +
        '      <div class="col-sm-10"> \n' +
        '          {formResource} \n' +
        '      </div> \n' +
        '   </div> \n' +
        '</div>',
        
        isEmpty = function (value, trim) {
            return value === null || value === undefined || value == []
                || value === '' || trim && $.trim(value) === '';
        },
        uniqId      = function () {
            return Math.round(new Date().getTime() + (Math.random() * 100));
        },
        textCapitalize = function(string)
        {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        isJsonString = function(str)
        {
            try {
                if ( typeof $.parseJSON(str) != "undefined" ) {
                    return true
                }
            } catch (e) {
                return false;
            }
        },
        arrayToObject = function(name, value, is_stringify)
        {
            var obj = {};
            for (var i = 0; i < name.length; ++i)
            {
                obj[name[i]] = value[i];
            }
            return (is_stringify) ? JSON.stringify(obj) : obj ;
        }

    var AsmoyoList = function (element, options) {
        this.$element   = $(element);
        this.init(options);
        this.listen();
    };

    AsmoyoList.prototype = {
        constructor: AsmoyoList,
        init: function (options) {
            this.options            = options;
            this.template           = options.template;
            this.currentValue       = ( isJsonString(this.$element.val()) ) ? $.parseJSON(this.$element.val()) : false ;
            this.fields             = this.getFields();

            if (isEmpty(this.$element.attr('id'))) {
                this.$element.attr('id', uniqId());
            }
            this.classEvent         = this.$element.attr('name') +'_items_'+ uniqId();
            this.render();
        },
        getFields: function()
        {
            try {
                if( typeof this.options.fields === 'undefined' )
                {
                    console.log(this.options.fileds);
                    return this.options.fields;
                } else if( isJsonString(this.$element.attr('data-fields')) ) {
                    return $.parseJSON( this.$element.attr('data-fields') );
                }
            } catch(e) {
                console.log('cok');
                return 'error';
            }
            
        },
        getTotalFields: function()
        {
            return Object.keys(this.fields).length;
        },
        generateFields: function()
        {
            var fields = this.fields,
                result = [];

            for (var key in fields) {
                var fieldName   = key,
                    fieldType   = fields[key],
                    value       = (typeof this.currentValue[fieldName] !== "undefined") 
                                ? this.currentValue[fieldName]
                                : '',
                    label, form;

                label   = textCapitalize(fieldName);

                switch (fieldType) {
                    case 'text':
                        form    = '<input type="text" class="form-control '+this.classEvent+'" name="'+ fieldName +'" value="'+ value +'" />';
                    break;
                    case 'textarea':
                        form    = '<textarea class="form-control '+this.classEvent+'" name="'+ fieldName +'" rows="4" >'+ value +'</textarea>';
                    break;
                    default:
                        form    = 'undefined';
                    break;
                }
                result.push({"name":fieldName, "label":label, "form":form});
            }
            return result;
        },
        render: function()
        {
            var generatedFields = this.generateFields(),
                itemId = [],
                result = [];
            
            for (var key in generatedFields) {
                result += this.template
                    .replace('{formResource}', generatedFields[key].form)
                    .replace('{labelResource}', generatedFields[key].label);
            }

            this.$element.before(result);
            this.$element.css({'visibility':'hidden', 'position':'absolute'});
            return result;
        },
        listen: function()
        {
            var targetEl    = this.$element,
                itemClass   = '.'+ this.classEvent;

            $('.'+ this.classEvent).keyup(function()
            {
                var itemName    = $(itemClass).map(function(i,v)
                {
                    return $(v).attr('name');
                }).get(),
                itemValue   = $(itemClass).map(function(i,v)
                {
                    return $(v).val();
                }).get();

                return targetEl.val( arrayToObject(itemName, itemValue, true) );
            });
        }
    };

    $.fn.asmoyolist = function (option) {
        var args = Array.apply(null, arguments);
        args.shift();
        return this.each(function () {
            var $this = $(this),
                data = $this.data('asmoyolist'),
                options = typeof option === 'object' && option;

            if (!data) {
                $this.data('asmoyolist', (data = new AsmoyoList(this, $.extend({}, $.fn.asmoyolist.defaults, options, $(this).data()))));
            }

            if (typeof option === 'string') {
                data[option].apply(data, args);
            }
        });
    };

    $.fn.asmoyolist.defaults = {
        template: TEMPLATE,
        fields: {"title":"text"}
    };

})(window.jQuery);