jQuery(function($) {
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table');
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
        }
        
        
        $('#btn_buscar_usuarios').click(function(){
            location.href = 'admin.php?action=usuarios&nombre='+$('#buscar_nombre').val();
        });
        $('#buscar_nombre').click(function(){
           $('#buscar_nombre').val('');
        });
        
       $('#btn_agregar').click(function(){
           location.href = 'admin.php?action=nmusuario';
       });
       $('#btn_mostrar').click(function(){
           location.href = 'admin.php?action=usuarios';
       });
        
        
});