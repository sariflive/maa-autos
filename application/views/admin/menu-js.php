<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqx.base.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqxdragdrop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jqwidgets/jqxtree.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jQuery.htmlClean/jQuery.htmlClean.js"></script>
<!-- filter input -->
<script src="<?php echo base_url(); ?>assets/admin/js/filter-input/jquery.filter_input.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        menu_validate.init();

        $('#menuname').filter_input({regex:'[a-zA-Z0-9_]'});
        $('#add_menu_item').on('click', function (event) {
            var defaults = {position: 'top-right', speed: 'fast', allowdupes: false, autoclose: 0, classList: '' };
            if($('#new_link_title').val() != '' && $('#new_link_url').val() != '') {
                $('#treeB').jqxTree('addTo', { label: '<a href=\''+$('#new_link_url').val()+'\'>'+$('#new_link_title').val()+'</a>' });
                $.stickyNote("<strong>Success!</strong> Menu Item added successfully!", $.extend({}, defaults, {autoclose: 5000}, {classList: 'stickyNote-success'}));
            }
            else $.stickyNote("<strong>Error!</strong> Please enter Item Title and URL", $.extend({}, defaults, {autoclose: 5000}, {classList: 'stickyNote-important'}));
        });
        
        $('#validate-menu').on('submit', function (event) {
            getmenu();
        });

        $("#treeA, #treeB").on('click', function (event) {
            event.preventDefault();
        }); 

        var theme = "";
        /* Create jqxTree*/
        $('#treeA').jqxTree({ allowDrag: true, allowDrop: true, height: '300px', width: '220px', theme: theme,
            dragStart: function (item) {
                if (item.label == "Community")
                return false;
            }
        });

        $('#treeB').jqxTree({ allowDrag: true, allowDrop: true, height: '300px', width: '220px', theme: theme,
            dragEnd: function (item, dropItem, args, dropPosition, tree) {
                if (item.label == "Forum")
                return false;
            }
        });

        $("#treeA, #treeB").on('dragStart', function (event) {
            $("#dragStartLog").text("Drag Start: " + event.args.label);
            $("#dragEndLog").text("");
        });
    
        $("#treeA, #treeB").on('dragEnd', function (event) {
            getmenu();
        });

        function getmenu() {
            html = $($("#treeB").html()).find('.jqx-widget-content').html();
            html = $.htmlClean(html, { format: true, removeTags: ["p","span", "div"], allowedClasses: ["primary-nav"<?php if(isset($menu['menu_class']) && !empty($menu['menu_class'])) echo ", \"{$menu['menu_class']}\"";?>] });  
            
            var cmenuid = $('#menuid').val();
            var cmenuclass = $('#menuclass').val();
        
            
            if(cmenuid == '') cmenuid = $('#menuname').val();
            <?php if(isset($menu['menu_class']) && !empty($menu['menu_class'])) {$varclass = $menu['menu_class'];} else $varclass='primary-nav';?>
            if(cmenuid != '') html = html.replace('<ul class="<?php echo $varclass;?>">', '<ul class="<?php echo $varclass;?>" id="'+cmenuid+'">');
            if(cmenuid != '') html = html.replace('<ul>', '<ul class="<?php echo $varclass;?>" id="'+cmenuid+'">');
            if(cmenuclass != '') html = html.replace('<?php echo $varclass;?>', cmenuclass);
            if(cmenuclass != '') html = html.replace('<?php echo $varclass;?>', cmenuclass);
            $('#content').val(html);    
        };
    });
    
    menu_validate = {
        init: function() {
            if($('#validate-menu').length) {
                $('#validate-menu').parsley({
                    errors: {
                        classHandler: function ( elem, isRadioOrCheckbox ) {
                            if(isRadioOrCheckbox) {
                                return $(elem).closest('.form_sep');
                            }
                        },
                        container: function (element, isRadioOrCheckbox) {
                            if(isRadioOrCheckbox) {
                                return element.closest('.form_sep');
                            }
                        }
                    }
                });
            }
        }
    };
</script>